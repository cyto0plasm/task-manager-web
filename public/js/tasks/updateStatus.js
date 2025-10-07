document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("update-status-form");
    const flash = document.getElementById("flash-message");

    if (!form) return;

    form.addEventListener("submit", function (e) {
        e.preventDefault();

        fetch(form.action, {
            method: "PATCH",
            headers: {
                "X-CSRF-TOKEN": form.querySelector('input[name="_token"]')
                    .value,
                "Content-Type": "application/json",
            },
            body: JSON.stringify({
                status: form.querySelector('input[name="status"]').value,
            }),
        })
            .then((res) => res.json())
            .then((data) => {
                // Show flash
                showFlash(data.success ? "success" : "error", data.message);

                // If updated successfully, update UI badge immediately
                if (data.success) {
                    const statusBadge = document.querySelector(".task-state");
                    const statusIcon = statusBadge.previousElementSibling;
                    statusBadge.className =
                        "task-state px-3 py-1 text-sm font-medium rounded-full bg-green-100 text-green-800";
                    statusBadge.innerText = "Done";

                    statusIcon.className =
                        "w-6 h-6 rounded-full flex items-center justify-center bg-green-500";
                    statusIcon.innerHTML = `<svg class="w-3.5 h-3.5 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>`;
                }
            })
            .catch(() => {
                showFlash("error", "Something went wrong.");
            });
    });

    function showFlash(type, message) {
        flash.textContent = message;
        flash.className =
            "fixed top-16 left-1/2 -translate-x-1/2 px-4 py-2 rounded shadow-md text-white opacity-0 transition-opacity duration-500 z-50";

        if (type === "success") flash.classList.add("bg-green-500");
        if (type === "error") flash.classList.add("bg-red-500");
        if (type === "info") flash.classList.add("bg-blue-500");

        flash.classList.remove("hidden");

        // fade in
        setTimeout(() => flash.classList.remove("opacity-0"), 50);

        // fade out after 3s
        setTimeout(() => flash.classList.add("opacity-0"), 3000);
    }
});
