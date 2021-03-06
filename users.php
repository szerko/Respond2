<?php	
	include 'app.php'; // import php files
	
	$authUser = new AuthUser(); // get auth user
	$authUser->Authenticate('All');
?>
<!DOCTYPE html>
<html>

<head>
	
<title>Users&mdash;<?php print $authUser->SiteName; ?></title>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- include css -->
<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/css/bootstrap-combined.no-icons.min.css" rel="stylesheet">
<link type="text/css" href="css/app.css" rel="stylesheet">
<link type="text/css" href="css/messages.css" rel="stylesheet">
<link type="text/css" href="css/list.css" rel="stylesheet">
<link href="//netdna.bootstrapcdn.com/font-awesome/3.1.1/css/font-awesome.min.css" rel="stylesheet">

</head>

<body data-currpage="users">

<?php include 'modules/menu.php'; ?>

<p id="message">
  <span>Holds the message text.</span>
  <a class="close" href="#"></a>
</p>
		
<section class="main">

    <nav>
        <a class="show-menu"><i class="icon-reorder icon-large"></i></a>
    
        <ul>
            <li class="static active"><a>Users</a></li>
        </ul>
        
        <a class="primary-action" data-bind="click: showAddDialog"><i class="icon-plus-sign icon-large"></i> Add User</span></a>
    </nav>

    <div class="list" data-bind="foreach: users">
    
        <div class="listItem" data-bind="attr: { 'data-id': userUniqId}">
    		<a class="remove" data-bind="click: $parent.showRemoveDialog">
                <i class="icon-minus-sign icon-large"></i>
            </a>
    		<h2><a data-bind="text:fullName, click: $parent.showEditDialog"></a></h2>
            <em>Created <span data-bind="text:friendlyDate"></span></em>
    	</div>
    	<!-- /.listItem -->
    
    </div>
    <!-- /.list -->
    
    <p data-bind="visible: usersLoading()" class="list-loading"><i class="icon-spinner icon-spin"></i> Loading...</p>
    
    <p data-bind="visible: usersLoading()==false && users().length < 1" class="list-none">No users here. Click Add User to get started.</p>
      

</section>
<!-- /.main -->

<div class="modal hide" id="addEditDialog">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">x</button>
    <h3 id="addEditTitle">Add User</h3>
  </div>
  <!-- /.modal-header -->

  <div class="modal-body">

  	<form class="form-horizontal">

		<div class="control-group">
			<label for="firstName" class="control-label">First Name:</label>
			<div class="controls">
				<input id="firstName" type="text">
			</div>
		</div>
		
		<div class="control-group">
			<label for="lastName" class="control-label">Last Name:</label>
			<div class="controls">
				<input id="lastName" type="text">
			</div>
		</div>

		<div class="control-group">
			<label for="role" class="control-label">Role:</label>
			<div class="controls">
				<select id="role">
					<option value="Admin">Administrator</option>
					<option value="Demo">Demo</option>
				</select>
			</div>
		</div>

		<div class="control-group">
			<label for="email" class="control-label">Email:</label>
			<div class="controls">
				<input id="email" type="text">
				<span class="help-block">Also used as the login</span>
			</div>
		</div>
	
		<div class="control-group">
			<label for="password" class="control-label">Password:</label>
			<div class="controls">
				<input id="password" type="password">
				<span class="help-block">More than 5 characters, 1 letter and 1 special character</span>
			</div>
		</div>
		
		<div class="control-group">
			<label for="retype" class="control-label">Retype Password:</label>
			<div class="controls">
				<input id="retype" type="password">
			</div>
		</div>
		
	</form>
	<!-- /.form-horizontal -->

	</div>
	<!-- /.modal-body -->

	<div class="modal-footer">
		<button class="secondary-button" data-dismiss="modal">Close</button>
		<button class="primary-button" type="button" data-bind="click: addEditUser">Add User</button>
	</div>

</div>
<!-- /.modal -->

<div class="modal hide" id="deleteDialog">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">x</button>
    <h3>Remove User</h3>
  </div>
  <!-- /.modal-header -->

    <div class="modal-body">
	
	<p>
		Are you sure that you want to delete <strong id="removeName">this user</strong>?
	</p>
	
	</div>
	<!-- /.modal-body -->

	<div class="modal-footer">
    	<button class="secondary-button" data-dismiss="modal">Close</button>
		<button class="primary-button" data-bind="click: removeUser">Remove User</button>
	</div>

</div>
<!-- /.modal -->

</form>

<?php include 'modules/footer.php'; ?>

</body>

<!-- include js -->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
<script type="text/javascript" src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/helper/knockout-2.2.0.js"></script>
<script type="text/javascript" src="js/helper/moment.min.js"></script>
<script type="text/javascript" src="js/global.js"></script>
<script type="text/javascript" src="js/dialog.js"></script>
<script type="text/javascript" src="js/messages.js"></script>
<script type="text/javascript" src="js/viewModels/models.js"></script>
<script type="text/javascript" src="js/viewModels/usersModel.js"></script>

</html>