function openModal(id) {
    document.getElementById(id).classList.remove("hidden");
    document.body.classList.add("overflow-hidden");
}

function closeModal(id) {
    document.getElementById(id).classList.add("hidden");
    document.body.classList.remove("overflow-hidden");
}

document.addEventListener("DOMContentLoaded", () => {
    const editButton = document.querySelector("#task-edit-btn");

    if (editButton) {
        editButton.addEventListener("click", async (e) => {
            e.preventDefault();

            const updateForm = document.querySelector("#update-status-form");
            const currentTaskId = updateForm?.action?.split("/").pop();

            if (!currentTaskId) {
                console.error("No current task ID found");
                return;
            }

            let task = taskCache[currentTaskId]; //  Try cache first

            if (!task) {
                // fallback if task not yet loaded
                try {
                    const response = await fetch(
                        `/tasks/edit/${currentTaskId}`
                    );
                    if (!response.ok)
                        throw new Error(`HTTP ${response.status}`);
                    task = await response.json();
                    taskCache[task.id] = task; // store for next time
                } catch (error) {
                    console.error("Error loading task:", error);
                    return;
                }
            }

            // populate fields
            document.querySelector("#edit-task-title").value = task.title || "";
            document;
            // .querySelectorAll('input[name="project_id"]')
            // .forEach((radio) => {
            //     radio.checked = radio.value == task.project_id;
            // });
            console.log("Setting project_id:", task.project_id);

            document.querySelector("#edit-task-description").value =
                task.description || "";
            document.querySelector("#edit-task-due-date").value = task.due_date
                ? new Date(task.due_date).toISOString().split("T")[0]
                : "";
            document.querySelector("#edit-task-priority").value =
                task.priority || "medium";
            document.querySelector("#edit-task-status").value =
                task.status || "pending";

            // update form action
            document.querySelector(
                "#edit-task-form"
            ).action = `/tasks/update/${task.id}`;

            openModal("edit-task-modal");
            setTimeout(() => {
                const inputs = document.querySelectorAll(
                    `input[name="project_id"][value="${task.project_id}"]`
                );
                inputs.forEach((input) => {
                    input.checked = true;

                    // Force repaint for Tailwind peer styling on mobile
                    const li = input.closest("label")?.querySelector("li");
                    if (li) li.classList.add("bg-gray-300");

                    input.dispatchEvent(new Event("change", { bubbles: true }));
                });

                const mobileDetails =
                    document.querySelector("#mobile-projects");
                if (mobileDetails && !mobileDetails.open)
                    mobileDetails.open = true;
            }, 100);
        });
    }
});
//code for task moadl to open fab menu
function toggleFabMenu(force = null) {
    const menu = document.getElementById("fab-menu");
    if (force === true) menu.classList.remove("hidden");
    else if (force === false) menu.classList.add("hidden");
    else menu.classList.toggle("hidden");
}
