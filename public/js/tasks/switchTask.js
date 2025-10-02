document.querySelectorAll(".task-item").forEach((button) => {
    button.addEventListener("click", function (e) {
        e.preventDefault();

        const url = this.dataset.taskUrl;
        // console.log("Clicked URL:", url);

        fetch(url)
            .then((response) => {
                //console.log("Response status:", response.status);
                return response.json();
            })
            .then((task) => {
                //console.log("Task data:", task);

                // Update text content
                document.querySelector(".task-title").innerText = task.title;
                document.querySelector(".task-description").innerText =
                    task.description;
                document.querySelector(".task-priority").innerText =
                    task.priority;
                document.querySelector(".task-time").innerText =
                    task.estimated_time;
                document.querySelector(".task-assigned").innerText =
                    task.assigned_to;

                // Update status badge and icon
                const statusBadge = document.querySelector(".task-state");
                const statusIcon = statusBadge.previousElementSibling; // circle div
                const iconInner = statusIcon.querySelector("div, svg"); // The inner element

                // Remove all existing status classes
                statusBadge.className =
                    "task-state px-3 py-1 text-sm font-medium rounded-full";
                statusIcon.className =
                    "w-6 h-6 rounded-full flex items-center justify-center";

                // Apply new status styling
                if (task.status === "done") {
                    statusBadge.classList.add("bg-green-100", "text-green-800");
                    statusBadge.innerText = "Done";
                    statusIcon.classList.add("bg-green-500");
                    iconInner.outerHTML = `<svg class="w-3.5 h-3.5 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>`;
                } else if (task.status === "in_progress") {
                    statusBadge.classList.add(
                        "bg-yellow-100",
                        "text-yellow-800"
                    );
                    statusBadge.innerText = "In Progress";
                    statusIcon.classList.add("bg-yellow-500");
                    iconInner.outerHTML =
                        '<div class="w-3 h-3 bg-white rounded-full animate-pulse"></div>';
                } else {
                    // pending
                    statusBadge.classList.add("bg-red-100", "text-red-800");
                    statusBadge.innerText = "Pending";
                    statusIcon.classList.add("bg-red-500");
                    iconInner.outerHTML =
                        '<div class="w-3 h-3 bg-white rounded-full"></div>';
                }
            })
            .catch((error) => console.error("Error:", error));
    });
});
