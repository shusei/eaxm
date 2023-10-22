<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Studio Classroom Interview Project - Front-end Developer</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <style>
    #app {
      padding-top: 1rem;
    }
  </style>
</head>
<body>
  <div id="app">
    <div class="container">
      <h1 class="h5 text-center">Studio Classroom Front-end Developer Mini Project</h1>

      <hr>

      <div class="text-center">
        <button type="button" class="btn btn-primary" id="fetchButton">Fetch</button>
        <button type="button" class="btn btn-warning" id="parseButton">Parse</button>
      </div>

      <hr>

      <h2 class="h5 text-black-50">User Info</h2>

      <dl class="row">

        <!-- This is an example -->
        <dt class="col-sm-3">First Name</dt>
        <dd class="col-sm-9" id="firstName"></dd>
        <dt class="col-sm-3">Last Name</dt>
        <dd class="col-sm-9" id="lastName"></dd>
        <dt class="col-sm-3">Company</dt>
        <dd class="col-sm-9" id="company"></dd>
        <dt class="col-sm-3">Phone</dt>
        <dd class="col-sm-9">
          <span style="color:red;"  id="phone"></span>
        </dd>

      </dl>

      <hr>

      <h2 class="h5 text-black-50">User List</h2>

      <table class="table table-sm table-bordered table-hover">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Username</th>
            <th scope="col">Name</th>
            <th scope="col">City</th>
            <th scope="col">Email</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody  id="userInfo">

        </tbody>
      </table>
    </div>
  </div>

  

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script>
  var token = $('meta[name="csrf-token"]').attr('content');
  var fetchedData;

  $(document).ready(function() {
    $('#fetchButton').click(function() {

        $.ajax({
            url: 'https://jsonplaceholder.typicode.com/users',
            method: 'GET',
            success: function(data) {
                fetchedData = data;
                data.sort(function(a, b) {
                    return b.id - a.id;
                });

                fillTable(data);
            }
        });
    });



    $('#parseButton').click(function() {
        // console.log(fetchedData),
        $.ajax({
            url: '/parseButton',
            method: 'POST',
            data: { data: fetchedData },
            headers: {
              'X-CSRF-TOKEN': token,
              'Accept': 'application/json',
            },
            success: function(response) {
                console.log(response),
              fillTable(response.data);
            },
            error: function(xhr, status, error) {
                console.log("Request failed with status: " + status);
                console.log("Error: " + error);
            }
        });
    });

    
    function fillTable(data) {
      var tableBody = $('#userInfo');
      tableBody.empty();

      data.forEach(function(user) {
            var row = '<tr>';
            row += '<td>' + user.username + '</td>';
            row += '<td>' + user.name + '</td>';
            row += '<td>' + user.address.city + '</td>';
            row += '<td>' + user.email + '</td>';
            row += '<td><button type="button" class="btn btn-info btn-sm detail-button" id="detail-button-' + user.username + '">Detail</button>';
            row += '<button type="button" class="btn btn-danger btn-sm delete-button" id="delete-button-' + user.username + '">Delete</button></td>';
            row += '</tr>';
            tableBody.append(row);
      });

        $('[id^="detail-button-"]').click(function() {
            var username = this.id.replace('detail-button-', '');

            var user = fetchedData.find(function(u) {
                return u.username === username;
            });

            // 忽略掉開頭是Mr.或Mrs.的名字部份
            var nameWithoutPrefix = user.name.replace(/^(Mr\.|Mrs\.)\s+/i, '');

            // 名字拆成First Last Name
            var nameParts = nameWithoutPrefix.split(' ');
            var firstName = nameParts[0];
            var lastName = nameParts.slice(1).join(' ');

            $('#firstName').text(firstName);
            $('#lastName').text(lastName);
            $('#company').text(user.company.name);
            $('#phone').text(user.phone);

            // "1"開頭的電話紅色
            if (user.phone.startsWith('1')) {
                $('#phone').css('color', 'red');
            } else {
                $('#phone').css('color', 'black');
            }
        });

        $('[id^="delete-button-"]').click(function() {
            var username = this.id.replace('delete-button-', '');
            var row = $(this).closest('tr');

            var userToDelete = fetchedData.find(function(user) {
                return user.username === username;
            });

            // 找到索引並刪除
            var indexToDelete = fetchedData.indexOf(userToDelete);
            if (indexToDelete !== -1) {
                fetchedData.splice(indexToDelete, 1);
            }

            row.remove();
        });
    }
  });
  </script>





</body>
</html>
