<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=yes">
    <meta name="csrf-token" content="<?php echo csrf_token(); ?>" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Users</title>
</head>
<style>
    #user-birthdate {
        display: block;
        width: 100%;
        padding: .375rem .75rem;
        font-size: 1rem;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: .25rem;
        transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    }
</style>
<body>

<nav class="navbar navbar-light bg-light justify-content-between">
    <a class="navbar-brand">User Manager</a>
    <form class="form-inline">
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Areas
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <?php foreach($areas as $area) { ?>
                    <a class="dropdown-item" href="<?php echo url('/'). '/filter/' . $area->id_area; ?>"><?php echo $area->area; ?></a>
                <?php } ?>
            </div>
        </div>
        <a href="<?php echo url('/') ?>"><button class="btn btn-outline-success my-2 my-sm-0" type="button" style="margin: 0 10px;">Clear</button></a>
        <button class="btn btn-outline-primary my-2 my-sm-0" type="button" style="margin: 0 10px;" onclick="addNewUser();">Add User</button>
    </form>
</nav>
<table class="table">
    <thead>
    <tr>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Birthday</th>
        <th scope="col">Active</th>
        <th scope="col">Actions</th>
    </tr>
    </thead>
    <tbody id="users">
    <?php foreach($users as $user) { ?>
    <tr id="user-<?php echo $user->id_user; ?>">
        <td><?php echo $user->first_name . " " . $user->last_name; ?></td>
        <td><?php echo $user->email; ?></td>
        <td><?php echo $user->birthdate; ?></td>
        <td><?php echo $user->active; ?></td>
        <td>
            <button id="detail-user-btn" data-user="<?php echo $user->id_user; ?>" onclick="openDetail(this);" type="button" class="btn btn-info">View</button>
            <button id="delete-user-btn" data-user="<?php echo $user->id_user; ?>" onclick="deleteUser(this);" type="button" class="btn btn-danger">Delete</button>
        </td>
    </tr>
    <?php } ?>
    </tbody>
</table>
<div class="modal" tabindex="-1" role="dialog" id="user-modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="user-detail">Detalle de usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="user-first-name">First name</label>
                        <input type="text" class="form-control" id="user-first-name" placeholder="First Name"/>
                    </div>
                    <div class="form-group">
                        <label for="user-last-name">Last name</label>
                        <input type="text" class="form-control" id="user-last-name" placeholder="First Name"/>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user-sex">Sex</label>
                                <input type="text" class="form-control" id="user-sex" placeholder="Sex"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user-birthdate">Birthdate</label><br>
                                <input id="user-birthdate" type="date" data-date="" data-date-format="YYYY MM DD"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="email" class="form-control" id="user-email" aria-describedby="emailHelp" placeholder="Enter email">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user-country">Country</label>
                                <select id="user-country" class="form-control" onchange="findStates();">
                                    <option selected>Choose...</option>
                                    <?php foreach($countries as $country) { ?>
                                    <option value="<?php echo $country->id_country; ?>"><?php echo $country->country_name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user-state">State</label>
                                <select id="user-state" class="form-control">
                                    <option selected>Choose...</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="user-address">Address</label>
                        <textarea rows="3" class="form-control" id="user-address" placeholder="Address"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="user-area">Area</label>
                        <select id="user-area" class="form-control">
                            <option selected>Choose...</option>
                            <?php foreach($areas as $area) { ?>
                                <option value="<?php echo $area->id_area; ?>"><?php echo $area->area; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button id="add-user" type="button" class="btn btn-primary" onclick="saveNewUser();">Save changes</button>
                <button id="edit-user" style="display: none;" type="button" class="btn btn-primary" onclick="editUser();">Edit</button>
            </div>
        </div>
    </div>
</div>
</body>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script type="text/javascript">

    const baseUrl = '<?php echo url('/'); ?>';

    const openDetail = ( element ) => {
        const userId = $(element).attr('data-user');
        localStorage.setItem('userId', userId);
        const viewUser = fetch(`${baseUrl}/detail/${userId}`)
            .then(response => response.json())
            .then(data => {
                if ( data !== null ) {
                    $("#user-first-name").val(data.user.first_name);
                    $("#user-last-name").val(data.user.last_name);
                    $("#user-sex").val(data.user.sex);
                    $("#user-birthdate").val(data.user.birthdate);
                    $("#user-email").val(data.user.email);
                    $("#user-country").val(data.user.id_country);
                    //$("#user-state").val(data.user.id_state);
                    $("#user-address").val(data.user.address);
                    $("#user-area").val(data.user.id_area);
                    $('#user-modal').modal('show');

                    console.log(data.user);

                    let states = data.states;
                    let html = '';
                    states.forEach((state) => {
                        if ( state.id_state === data.user.id_state) {
                            html += `<option selected value="${state.id_state}">${state.state_name}</option>`;
                        } else {
                            html += `<option value="${state.id_state}">${state.state_name}</option>`;
                        }
                    });
                    $("#user-state").html(html);
                    $("#add-user").hide();
                    $("#edit-user").show();
                }
            });
    }

    const deleteUser = () => {
        Swal.fire({
            title: 'Do you want to delete this user?',
            showCancelButton: true,
            confirmButtonText: 'Delete',
            confirmButtonColor: '#d33',
            denyButtonText: `Cancel`,
        }).then((result) => {
            if (result.isConfirmed) {
                const userId = document.getElementById('delete-user-btn').getAttribute('data-user');
                const deleteUser = fetch(`${baseUrl}/delete/${userId}`)
                    .then(response => response.json())
                    .then(data => {
                        if ( data !== null ) {
                            alert('User deleted successfully');
                            document.getElementById(`user-${userId}`).remove();
                        }
                    });
            }
        })
    }

    const addNewUser = () => {
        $('#user-modal').modal('show');
    }

    const saveNewUser = () => {
        let firstName = $("#user-first-name").val();
        let lastName =  $("#user-last-name").val();
        let sex = $("#user-sex").val();
        let birthdate = $("#user-birthdate").val();
        let email = $("#user-email").val();
        let country = $("#user-country").val();
        let state = $("#user-state").val();
        let address = $("#user-address").val();
        let area = $("#user-area").val();
        let dataForm = {
            firstName,
            lastName,
            sex,
            birthdate,
            email,
            country,
            state,
            address,
            area
        }
        let config = {
            url: `${baseUrl}/add`,
            data: dataForm,
            type: 'POST',
            dataType: 'json',
        };
        $.ajax(config).done((response) => {
            if ( response !== null ) {
                alert('User added successfully');
                $('#user-modal').modal('hide');
                let chain = `<tr id="user-6">
                                <td>${firstName} ${lastName}</td>
                                <td>${email}</td>
                                <td>${birthdate}</td>
                                <td>1</td>
                                <td>
                                    <button id="detail-user-btn" data-user="${response}" onclick="openDetail();" type="button" class="btn btn-info">View</button>
                                    <button id="delete-user-btn" data-user="${response}" onclick="deleteUser();" type="button" class="btn btn-danger">Delete</button>
                                </td>
                            </tr>`;
                $("#users").append(chain);
            }
        }).fail((response) => {

        });
    }

    const findStates = () => {
        let country = $("#user-country").val();
        let dataForm = {
            country
        }
        let config = {
            url: `${baseUrl}/findStates`,
            data: dataForm,
            type: 'POST',
            dataType: 'json',
        };
        $.ajax(config).done((response) => {
            console.log(response);
            if(response !== null) {
                let states = response.states;
                let html = '';
                states.forEach((state) => {
                    html += `<option value="${state.id_state}">${state.state_name}</option>`;
                });
                $("#user-state").html(html);
            }
        }).fail((response) => {

        });
    }

    const editUser = ( ) => {
        let firstName = $("#user-first-name").val();
        let lastName =  $("#user-last-name").val();
        let sex = $("#user-sex").val();
        let birthdate = $("#user-birthdate").val();
        let email = $("#user-email").val();
        let country = $("#user-country").val();
        let state = $("#user-state").val();
        let address = $("#user-address").val();
        let area = $("#user-area").val();
        let dataForm = {
            firstName,
            lastName,
            sex,
            birthdate,
            email,
            country,
            state,
            address,
            area
        }
        let config = {
            url: `${baseUrl}/edit`,
            data: dataForm,
            type: 'PUT',
            dataType: 'json',
        };
        $.ajax(config).done((response) => {
            if ( response !== null ) {
                alert('User added successfully');
                $('#user-modal').modal('hide');
                let chain = `<tr id="user-6">
                                <td>${firstName} ${lastName}</td>
                                <td>${email}</td>
                                <td>${birthdate}</td>
                                <td>1</td>
                                <td>
                                    <button id="detail-user-btn" data-user="${response}" onclick="openDetail();" type="button" class="btn btn-info">View</button>
                                    <button id="delete-user-btn" data-user="${response}" onclick="deleteUser();" type="button" class="btn btn-danger">Delete</button>
                                </td>
                            </tr>`;
                $("#users").append(chain);
            }
        }).fail((response) => {

        });
    }


</script>
</html>
