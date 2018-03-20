<?php
    include("./header.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Administrator</title>
    <!-- Bootstrap core CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/adminStyle.css">
    
</head>
<body>
    <div class="tab">
        <button id="btn-show-organizer">Organizer</button>
        <button id="btn-show-attendant">Attendant</button>
        <button id="btn-show-event">Event</button>
    </div>
    <div class="container" role="main">
        <!-- Organizer -->
        <div class="row" id="show-organizer">

            <div class="col-12" style="text-align: center;">
                <span style="font-size: 1.5em;">Organizer List</span>
            </div>

            <div class="col-12" style="text-align: right;">
                <a href="./php/exportPDF/exportPDFOrganizer.php" target="_blank">
                    <button id="btn-export-organizer">Export PDF</button>
                </a>
            </div>

            <div class="col-12" style="text-align: center;">
                Seach: <input oninput="w3.filterHTML('.organizer-list', '#list', this.value)" placeholder="search for a word" style="margin-bottom: 10px;">
            </div>

            <div class="col-12">
                <table>
                    <thead>
                        <tr>
                            <th onclick="w3.sortHTML('.organizer-list', '#list', 'td:nth-child(1)')" scope="col" style="width: 100px;">ID</th>
                            <th onclick="w3.sortHTML('.organizer-list', '#list', 'td:nth-child(2)')" scope="col" style="width: 200px;">User Name</th>
                            <th onclick="w3.sortHTML('.organizer-list', '#list', 'td:nth-child(3)')" scope="col" style="width: 200px;">Organizer Name</th>
                            <th onclick="w3.sortHTML('.organizer-list', '#list', 'td:nth-child(4)')" scope="col" style="width: 200px;">E-mail</th>
                            <th onclick="w3.sortHTML('.organizer-list', '#list', 'td:nth-child(5)')" scope="col" style="width: 150px;">Phone</th>
                        </tr>
                    </thead>
                    <tbody class="organizer-list">
                    </tbody>
                </table>
            </div>
            <div class="col-12" style="text-align: center;">
                <button id="btn-add-organizer">Add User</button>
            </div>

            <!-- form for add organizer -->
            <div id="form-add-organizer">
                <form id="organizer-adding-form">
                    <div class="row">
                        <div class="col">
                            <div class="row">Username:</div>
                            <div class="row">Password:</div>
                            <div class="row">Organization Name:</div>
                            <div class="row">E-mail:</div>
                            <div class="row">Phone:</div>
                        </div>
                        <div class="col">
                            <div class="row"><input type="text" id="userID"></div>
                            <div class="row"><input type="text" id="pwd"></div>
                            <div class="row"><input type="text" id="orgName"></div>
                            <div class="row"><input type="text" id="email"></div>
                            <div class="row"><input type="text" id="phone"></div>
                            <div class="row" style="text-align: center;">
                                <button id="confirm-add-organizer" type="button">Add</button>
                                <button id="cancel-add-organizer" type="button">Cancel</button>
                            </div>
                        </div>
                    </div> 
                </form>
            </div>
            <!-- form for edit organizer -->
            <div id="form-edit-organizer">
                <form id="organizer-editing-form">
                    <div class="row">
                        <div class="col">
                            <div class="row">ID:</div>
                            <div class="row">User Name:</div>
                            <div class="row">Organization Name:</div>
                            <div class="row">E-mail:</div>
                            <div class="row">Phone:</div>
                        </div>
                        <div class="col">
                            <div class="row"><div class="col"><div id="id-edit1">ID</div></div></div>
                            <div class="row"><div class="col"><div id="userID-edit1">userID</div></div></div>
                            <div class="row"><input type="text" id="orgName-edit1"></div>
                            <div class="row"><input type="text" id="email-edit1"></div>
                            <div class="row"><input type="text" id="phone-edit1"></div>
                            <div class="row" style="text-align: center;">
                                <button id="confirm-edit-organizer" type="button">Confirm</button>
                                <button id="cancel-edit-organizer" type="button">Cancel</button>
                            </div>                            
                        </div>
                    </div>
                </form>
            </div>
            <!-- delete organizer-->
            <div id="alert-delete-organizer">
                <form id="alert-delete-form">
                    <div class="row">
                        <div class="col">
                            <div class="row">ID:</div>
                            <div class="row">User Name:</div>
                        </div>
                        <div class="col">
                            <div class="row"><div class="col"><div id="id-delete1">ID</div></div></div>
                            <div class="row"><div class="col"><div id="userID-delete1">userID</div></div></div>
                        </div>
                    </div>
                    <div class="row" style="text-align: center;">
                        <div class="col">
                            <button id="confirm-delete-organizer" type="button">Delete</button>
                        </div>
                        <div class="col">
                            <button id="cancel-delete-organizer" type="button">Cancel</button>
                        </div>
                    </div> 
                </form>
            </div>

            <ul> Notation:
                <li>Sort -> Click on Head Table</li>
                <li>Edit -> Double Click</li>
                <li>Delete -> Right Click</li>
            </ul>
                
        </div>
        
        <!-- Attendant -->
        <div class="row" id="show-attendant">
            <div class="col-12" style="text-align: center;">
                <span style="font-size: 1.5em;">Attendant List</span>
            </div>

            <div class="col-12" style="text-align: right;">
                <a href="./php/exportPDF/exportPDFAttendant.php" target="_blank">
                    <button id="btn-export-attendant">Export PDF</button>
                </a>
            </div>

            <div class="col-12" style="text-align: center;">
                Seach: <input oninput="w3.filterHTML('.attendant-list', '#list', this.value)" placeholder="search for a word" style="margin-bottom: 10px;">
            </div>

            <div class="col-12">
                <table>
                    <thead>
                        <tr>
                            <th onclick="w3.sortHTML('.attendant-list', '#list', 'td:nth-child(1)')" scope="col" style="width: 100px;">ID</th>
                            <th onclick="w3.sortHTML('.attendant-list', '#list', 'td:nth-child(2)')" scope="col" style="width: 200px;">User Name</th>
                            <th onclick="w3.sortHTML('.attendant-list', '#list', 'td:nth-child(3)')" scope="col" style="width: 200px;">Display Name</th>
                            <th onclick="w3.sortHTML('.attendant-list', '#list', 'td:nth-child(4)')" scope="col" style="width: 200px;">First Name</th>
                            <th onclick="w3.sortHTML('.attendant-list', '#list', 'td:nth-child(5)')" scope="col" style="width: 200px;">Last Name</th>
                            <th onclick="w3.sortHTML('.attendant-list', '#list', 'td:nth-child(6)')" scope="col" style="width: 200px;">E-mail</th>
                            <th onclick="w3.sortHTML('.attendant-list', '#list', 'td:nth-child(7)')" scope="col" style="width: 50px;">age</th>
                            <th onclick="w3.sortHTML('.attendant-list', '#list', 'td:nth-child(8)')" scope="col" style="width: 150px;">Phone</th>
                            <th onclick="w3.sortHTML('.attendant-list', '#list', 'td:nth-child(9)')" scope="col" style="width: 100px;">Gender</th>
                        </tr>
                    </thead>
                    <tbody class="attendant-list"></tbody>
                </table>
            </div>
            <div class="col-12" style="text-align: center;">
                <button id="btn-add-attendant">Add User</button>
            </div>
            

            <!-- form for add attendant -->
            <div id="form-add-attendant">
                <form id="attendant-adding-form">
                    <div class="row">
                        <div class="col">Username:</div>
                        <div class="col"><input type="text" id="userID2"></div>
                    </div>
                    <div class="row">
                        <div class="col">Password:</div>
                        <div class="col"><input type="text" id="pwd2"></div>
                    </div>
                    <div class="row">
                        <div class="col">Display Name:</div>
                        <div class="col"><input type="text" id="displayName2"></div>
                    </div>                    
                    <div class="row">
                        <div class="col">First Name:</div>
                        <div class="col"><input type="text" id="fName2"></div>
                    </div>
                    <div class="row">
                        <div class="col">Last Name:</div>
                        <div class="col"><input type="text" id="lName2"></div>
                    </div>
                    <div class="row">
                        <div class="col">Age:</div>
                        <div class="col"><input type="number" min="8" max="100" id="age2"> Years old</div>
                    </div>                    
                    <div class="row">
                        <div class="col">E-mail:</div>
                        <div class="col"><input type="text" id="email2"></div>
                    </div>
                    <div class="row">
                        <div class="col">Phone:</div>
                        <div class="col"><input type="text" id="phone2"></div>
                    </div>
                    <div class="row">
                        <div class="col">Gender:</div>
                        <div class="col">
                            <input type="radio" id="male2" name="gender" value="male" checked> Male
                            <input type="radio" id="female2" name="gender" value="female" > Female
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col"></div>
                        <div class="col" style="text-align: center;">
                            <button id="confirm-add-attendant" type="button">Add</button>
                            <button id="cancel-add-attendant" type="button">Cancel</button>
                        </div>
                    </div> 
                </form>
            </div>

            <!-- form for edit attendant -->
            <div id="form-edit-attendant">
                <form id="attendant-editing-form">
                    <div class="row">
                        <div class="col">
                            <div class="row">ID:</div>
                            <div class="row">User Name:</div>
                            <div class="row">Display Name:</div>                            
                            <div class="row">First Name:</div>
                            <div class="row">Last Name:</div>
                            <div class="row">E-mail:</div>
                            <div class="row">Age:</div>
                            <div class="row">Phone:</div>
                        </div>
                        <div class="col">
                            <div class="row"><div class="col"><div id="id-edit2">ID</div></div></div>
                            <div class="row"><div class="col"><div id="userID-edit2">ID</div></div></div>
                            <div class="row"><input type="text" id="displayName-edit2"></div>
                            <div class="row"><input type="text" id="firstName-edit2"></div>
                            <div class="row"><input type="text" id="lastName-edit2"></div>
                            <div class="row"><input type="text" id="email-edit2"></div>
                            <div class="row"><input type="number" min="8" max="100" id="age-edit2"> Years old</div>
                            <div class="row"><input type="text" id="phone-edit2"></div>
                            <div class="row" style="text-align: center;">
                                <button id="confirm-edit-attendant" type="button">Confirm</button>
                                <button id="cancel-edit-attendant" type="button">Cancel</button>
                            </div>                            
                        </div>
                    </div>
                </form>
            </div>

            <!-- delete attendant-->
            <div id="alert-delete-attendant">
                <form id="alert-delete-form">
                    <div class="row">
                        <div class="col">
                            <div class="row">ID:</div>
                            <div class="row">User Name:</div>
                        </div>
                        <div class="col">
                            <div class="row"><div class="col"><div id="id-delete2">ID</div></div></div>
                            <div class="row"><div class="col"><div id="userID-delete2">userID</div></div></div>
                        </div>
                    </div>
                    <div class="row" style="text-align: center;">
                        <div class="col">
                            <button id="confirm-delete-attendant" type="button">Delete</button>
                        </div>
                        <div class="col">
                            <button id="cancel-delete-attendant" type="button">Cancel</button>
                        </div>
                    </div> 
                </form>
            </div>
            <ul> Notation:
                <li>Sort -> Click on Head Table</li>
                <li>Edit -> Double Click</li>
                <li>Delete -> Right Click</li>
            </ul>            
        </div>


        <!-- Event -->
        <div class="row" id="show-event">
            <div class="col-12" style="text-align: center;">
                <span style="font-size: 1.5em;">Event List</span>
            </div>
            
            <div class="col-12" style="text-align: right;">
                <a href="./php/exportPDF/exportPDFEvent.php" target="_blank">
                    <button id="btn-export-event">Export PDF</button>
                </a>
            </div>     

            <div class="col-12" style="text-align: center;">
                Seach: <input oninput="w3.filterHTML('.event-list', '#list', this.value)" placeholder="search for a word" style="margin-bottom: 10px;">
            </div>

            <div class="col-12">
                <table>
                    <thead>
                        <tr>
                            <th onclick="w3.sortHTML('.event-list', '#list', 'td:nth-child(1)')" scope="col" style="width: 100px;">ID</th>
                            <th onclick="w3.sortHTML('.event-list', '#list', 'td:nth-child(2)')" scope="col" style="width: 200px;">Start Date</th>
                            <th onclick="w3.sortHTML('.event-list', '#list', 'td:nth-child(3)')" scope="col" style="width: 200px;">End Date</th>
                            <th onclick="w3.sortHTML('.event-list', '#list', 'td:nth-child(4)')" scope="col" style="width: 200px;">Event Name</th>
                            <th onclick="w3.sortHTML('.event-list', '#list', 'td:nth-child(5)')" scope="col" style="width: 350px;">Location</th>
                            <th onclick="w3.sortHTML('.event-list', '#list', 'td:nth-child(6)')" scope="col" style="width: 100px;">Capacity</th>
                            <th onclick="w3.sortHTML('.event-list', '#list', 'td:nth-child(7)')" scope="col" style="width: 100px;">Price</th>
                            <th onclick="w3.sortHTML('.event-list', '#list', 'td:nth-child(8)')" scope="col" style="width: 200px;">Type</th>
                            <th onclick="w3.sortHTML('.event-list', '#list', 'td:nth-child(9)')" scope="col" style="width: 250px;">Organizer Name</th>
                        </tr>
                    </thead>
                    <tbody class="event-list"></tbody>
                </table>
            </div>
<!--             <div class="col-12" style="text-align: center;">
                <button id="">save</button>
            </div> -->

            <ul> Notation:
                <li>Sort -> Click on Head Table</li>
            </ul>
        </div>


    </div>


    <!-- Loading Scripts -->
    <!-- Bootstrap core JavaScript -->
    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js" integrity="sha384-FzT3vTVGXqf7wRfy8k4BiyzvbNfeYjK+frTVqZeNDFl8woCbF0CYG6g2fMEFFo/i" crossorigin="anonymous"></script>

    <!-- for search -->
    <script src="https://www.w3schools.com/lib/w3.js"></script>

    <script src="js/moment.js"></script>
    <script src="js/adminScripts.js"></script>

</body>
</html>