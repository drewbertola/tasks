const task = {
    showCompleted : false,

    initShowCompleted : () => {
        const showCompletedSwitch = document.getElementById('showCompleted');

        showCompletedSwitch.checked = task.showCompleted;

        task.updateShowCompleted();
    },

    toggleShowCompleted : () => {
        task.showCompleted = ! task.showCompleted;
        task.updateShowCompleted();
    },

    updateShowCompleted : () => {
        const rows = document.getElementById('taskTable').querySelectorAll('tr.dataRow');

        rows.forEach(function(row, index) {
            if (row.querySelector('.status').innerHTML === 'Completed') {
                if (task.showCompleted) {
                    row.classList.remove('d-none');
                } else {
                    row.classList.add('d-none');
                }
            }
        });
    },

    init : () => {
        task.initShowCompleted();
    }
};

document.addEventListener("htmx:load", (e) => {
    task.init();
});
