(function(d){

	var tasksDropdown = d.querySelector('.tasks-header__users-dropdown'),
			tasksContent  = d.querySelector('.tasks-list'),
			tasksError    = d.querySelector('.tasks-list__task--error'),
			tasksAbsent   = d.querySelector('.tasks-list__task--absent'),

			taskHidden    = 'tasks-list__task--hidden',
			task          = 'tasks-list__task',
			tasksItems;


	/**
	 * Shows for which user tasks should be displayed.
	 * 0 displays tasks for everyone.
	 */

	var currentUser = 0;

	tasksDropdown.addEventListener('change', getUserTasks, false);

	function getUserTasks(){

		var selectedUser = +this.value;


		if(selectedUser !== currentUser){
			var xhr = new XMLHttpRequest();
			xhr.open('GET', '/user/' + encodeURIComponent(selectedUser), true);

			xhr.onload = function(e){
				if(this.status === 200){
					tasksError.classList.add(taskHidden);
					renderTasks(this.responseText);
					currentUser = selectedUser;
				} else {
					tasksError.setAttribute('data-error', this.status);
					tasksError.classList.remove(taskHidden);
				}
			}

			xhr.send();
		}
	}

	function renderTasks(response){
		var response = JSON.parse(response);
		var li;

		if(response.length > 0){
			tasksAbsent.classList.add(taskHidden);
			deleteCurrentTasks();

			for(var _j = 0; _j < response.length; _j++){
				li = d.createElement('li');
				li.className = task;
				li.innerHTML = '\
					<h2 class="tasks-list__task-title">'+ response[_j].task_title +'</h2>\
					<span class="tasks-list__task-assignee">'+ response[_j].user_name +'</span>\
				';
				tasksContent.appendChild(li);
			}

		} else {
			tasksAbsent.classList.remove(taskHidden);
			deleteCurrentTasks();
		}
	}

	function deleteCurrentTasks(){
		tasksItems = document.querySelectorAll('.tasks-list__task');
		if(tasksItems.length > 2){
			for(var _i = 2; _i < tasksItems.length; _i++){
				tasksItems[_i].outerHTML = '';
			}
		}
	}

})(document);
