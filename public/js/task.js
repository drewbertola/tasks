const task = {
    init : () => {
        task.initForm();
    },

    initForm : () => {
        // const taskForm = document.getElementById('taskForm');

        // if (taskForm) {
        //     document.getElementById('referrer').value = document.location.pathname;
        // }
    },
};

document.addEventListener("htmx:load", (e) => {
    task.init();
});
