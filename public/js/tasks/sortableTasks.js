document.addEventListener("DOMContentLoaded", function () {
    const list = document.getElementById("sortable-list");
    const reorderUrl = list.dataset.url;
    const csrfToken = list.dataset.csrf;

    new Sortable(list, {
        animation: 150,
        ghostClass: "bg-yellow-100",

        // Auto-save when drag ends
        onEnd: function () {
            let order = [];
            list.querySelectorAll("li").forEach((ele, index) => {
                order.push({
                    id: ele.dataset.id,
                    position: index + 1,
                });
            });

            fetch(reorderUrl, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": csrfToken,
                },
                body: JSON.stringify({ order: order }),
            })
                .then((res) => res.json())
                .then((data) => {
                    console.log("Order auto-saved:", data);
                })
                .catch((err) => console.error("Auto-save failed:", err));
        },
    });
});
