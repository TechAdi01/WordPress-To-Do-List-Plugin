jQuery(document).ready(function($) {
    function renderTasks(tasks) {
        $('#checkitof-task-list').html('');
        tasks.forEach((task, index) => {
            let li = $('<li></li>');
            li.text(task.task);
            li.toggleClass('completed', task.completed);

            li.click(() => toggleTask(index));

            let deleteBtn = $('<button style="margin-left:10px;">🗑️</button>');
            deleteBtn.click(e => {
                e.stopPropagation(); // stop li click
                deleteTask(index);
            });

            li.append(deleteBtn);
            $('#checkitof-task-list').append(li);
        });
    }

    function fetchTasks() {
        $.post(checkitof_ajax.ajax_url, {
            action: 'checkitof_get_tasks'
        }, response => {
            if (response.success) renderTasks(response.data);
        });
    }

    function toggleTask(index) {
        $.post(checkitof_ajax.ajax_url, {
            action: 'checkitof_toggle_task',
            index: index
        }, response => {
            if (response.success) renderTasks(response.data);
        });
    }

    function deleteTask(index) {
        $.post(checkitof_ajax.ajax_url, {
            action: 'checkitof_delete_task',
            index: index
        }, response => {
            if (response.success) renderTasks(response.data);
        });
    }

    $('#checkitof-add-btn').click(function() {
        let task = $('#checkitof-new-task').val();
        if (task.length === 0) return;

        $.post(checkitof_ajax.ajax_url, {
            action: 'checkitof_save_task',
            task: task
        }, function(response) {
            if (response.success) {
                renderTasks(response.data);
                $('#checkitof-new-task').val('');
            }
        });
    });

    fetchTasks(); // Load all tasks on page load
});
