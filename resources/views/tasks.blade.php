<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Laratasks</title>
	<link rel="stylesheet" href="assets/tasks.css">
</head>
<body>
  <header class="tasks-header">
  	<h1 class="tasks-header__title">Tasks</h1>
  	<p class="tasks-header__description">Choose a user from dropdown below to see assigned tasks</p>
  	<select class="tasks-header__users-dropdown">
  		<option value="0" selected>All Users</option>
  		@foreach($users as $user)
        <option value="{{ $user->user_id }}">{{ $user->user_name }}</option>
      @endforeach
  	</select>
  </header>
  <ul class="tasks-list">
  	<li class="tasks-list__task tasks-list__task--error tasks-list__task--hidden" data-error="404">
  		Oops, an error occured! Error code:
  	</li>
  	<li class="tasks-list__task tasks-list__task--absent tasks-list__task--hidden">
  		Tasks were not found for this user.
  	</li>
    @foreach($tasks as $task)
      <li class="tasks-list__task">
        <h2 class="tasks-list__task-title">{{ $task->task_title }}</h2>
        <span class="tasks-list__task-assignee">{{ $task->user_name }}</span>
      </li>
    @endforeach
  </ul>
  <script src="assets/tasks.js" async defer></script>
</body>
</html>
