function banUser(userId) {
    var banId = document.getElementById("banId-" + userId);
    if (banId.innerHTML == 1) {
        var action = "ban";
        var newStatus = 0;
    } else {
        action = "unban";
        newStatus = 1;
    }
    if (confirm("Are you sure you want to " + action + " User with ID " + userId + " ?")) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.status == 200 && this.readyState == 4) {
                if (newStatus == 0) {
                    banId.innerHTML = 0;
                } else {
                    banId.innerHTML = 1;
                }
            }
        };
        xhttp.open("GET", "../../../controller/admin/users/ban_user_controller.php?uid="
            + userId + "&stat=" + newStatus, true);
        xhttp.send();
    }
}

function changeRole(userId) {
    var roleId = document.getElementById("roleId-" + userId);
    if (roleId.innerHTML == 1) {
        var action = "make";
        var newRole = 2;
    } else if (roleId.innerHTML == 2) {
        action = "unmake";
        newRole = 1;
    } else {
        alert("You cannot change the role of admin");
        throw "";
    }
    if (confirm("Are you sure you want to " + action + " moderator User with ID " + userId + " ?")) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.status == 200 && this.readyState == 4) {
                if (newRole == 2) {
                    roleId.innerHTML = 2;
                } else {
                    roleId.innerHTML = 1;
                }
            }
        };
        xhttp.open("GET", "../../../controller/admin/users/moderator_user_controller.php?uid="
            + userId + "&nrole=" + newRole, true);
        xhttp.send();
    }
}