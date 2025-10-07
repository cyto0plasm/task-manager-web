// ----------------------------------------------------------
// ⚙️ State Management
// ----------------------------------------------------------
let loading = false;

// ✅ This is your in-memory cache (state layer)
const taskCache = {}; // { [id]: taskJson }
let activeTaskId = null; // Track currently viewed task

// ----------------------------------------------------------
// Skeleton loading helpers
// ----------------------------------------------------------
function showSkeleton() {
    document.getElementById("taskDetailSkeleton")?.classList.remove("hidden");
    document.getElementById("taskDetailContent")?.classList.add("hidden");
}

function hideSkeleton() {
    document.getElementById("taskDetailSkeleton")?.classList.add("hidden");
    document.getElementById("taskDetailContent")?.classList.remove("hidden");
}

function setText(selector, value) {
    const el = document.querySelector(selector);
    if (el) el.innerText = value;
}

// ----------------------------------------------------------
// 🧩 Core: Load a task (with cache + reactive update)
// ----------------------------------------------------------
async function LoadTask(url) {
    if (loading) return;
    loading = true;
    showSkeleton();

    const start = Date.now();

    try {
        // 1️⃣ Extract task ID from the URL (assuming /tasks/show/{id})
        const id = parseInt(url.split("/").pop());

        // 2️⃣ If cached → skip fetch and just re-render
        if (taskCache[id]) {
            //console.log("Loaded from cache:", id);
            populateTaskDetail(taskCache[id]);
            hideSkeleton();
            loading = false;
            return;
        }

        // 3️⃣ Otherwise fetch from server
        const response = await fetch(url);
        if (!response.ok) throw new Error(`HTTP ${response.status}`);
        const task = await response.json();

        // 4️⃣ Store task in memory
        activeTaskId = task.id;
        taskCache[activeTaskId] = task;

        // 5️⃣ Ensure at least 300ms for UX consistency
        const elapsed = Date.now() - start;
        await new Promise((r) => setTimeout(r, Math.max(300 - elapsed, 0)));

        populateTaskDetail(task);
    } catch (err) {
        console.error("Error loading task:", err);
    } finally {
        hideSkeleton();
        loading = false;
    }
}

// ----------------------------------------------------------
// 🔁 DOM → State connection
// ----------------------------------------------------------
document.addEventListener("click", (e) => {
    const button = e.target.closest(".task-item");
    if (!button) return;

    e.preventDefault();

    document
        .querySelectorAll(".task-item.active")
        .forEach((item) => item.classList.remove("active"));

    button.classList.add("active");

    const url = button.dataset.taskUrl;
    if (url) LoadTask(url);
});

// ----------------------------------------------------------
// 🚀 Auto-load first task
// ----------------------------------------------------------
document.addEventListener("DOMContentLoaded", () => {
    const firstTask = document.querySelector(".task-item");
    if (firstTask) {
        firstTask.classList.add("active");
        LoadTask(firstTask.dataset.taskUrl);
    }
});

// ----------------------------------------------------------
// 🎨 Render (View Layer)
// ----------------------------------------------------------
function populateTaskDetail(task) {
    // update forms
    document
        .querySelector("#update-status-form")
        ?.setAttribute("action", `/tasks/status-update/${task.id}`);

    // title, desc, etc
    setText(".task-title", task.title || "Untitled");
    setText(".task-description", task.description || "No description");
    setText(".task-priority", task.priority || "-");
    setText(".task-type", task.type || "-");
    setText(".project", task.project_name || "No project");

    const timeEl = document.querySelector(".task-time");
    if (timeEl && task.due_date) {
        const date = new Date(task.due_date);
        timeEl.innerText = date.toISOString().split("T")[0];
    }

    // ✅ Status + icon logic (unchanged, just more compact)
    const statusBadge = document.querySelector(".task-state");
    const statusIcon = statusBadge?.previousElementSibling;
    const iconInner = statusIcon?.querySelector("div, svg");

    if (statusBadge) {
        statusBadge.className =
            "task-state px-3 py-1 text-sm font-medium rounded-full";
        statusIcon.className =
            "w-6 h-6 rounded-full flex items-center justify-center";

        if (task.status === "done") {
            statusBadge.classList.add("bg-green-100", "text-green-800");
            statusBadge.innerText = "Done";
            statusIcon.classList.add("bg-green-500");
            if (iconInner)
                iconInner.outerHTML = `<svg class="w-3.5 h-3.5 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                        clip-rule="evenodd" />
                </svg>`;
        } else if (task.status === "in_progress") {
            statusBadge.classList.add("bg-yellow-100", "text-yellow-800");
            statusBadge.innerText = "In Progress";
            statusIcon.classList.add("bg-yellow-500");
            if (iconInner)
                iconInner.outerHTML =
                    '<div class="w-3 h-3 bg-white rounded-full animate-pulse"></div>';
        } else {
            statusBadge.classList.add("bg-red-100", "text-red-800");
            statusBadge.innerText = "Pending";
            statusIcon.classList.add("bg-red-500");
            if (iconInner)
                iconInner.outerHTML =
                    '<div class="w-3 h-3 bg-white rounded-full"></div>';
        }
    }
}
