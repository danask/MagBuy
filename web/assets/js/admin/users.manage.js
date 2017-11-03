function banUser(userId) {
    var banId = document.getElementById("banId-" + userId);
    if (banId.innerHTML == "BANNED") {
        var action = "unban";
        var newStatus = 1;
    } else {
        action = "ban";
        newStatus = 0;
    }
    if (confirm("Are you sure you want to " + action + " User with ID " + userId + " ?")) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.status == 500 && this.readyState == 4) {
                window.location.replace("../error/error_500.php");
            } else if (this.status == 400 && this.readyState == 4) {
                window.location.replace("../error/error_400.php");
            } else if (this.status == 200 && this.readyState == 4) {
                if (newStatus == 0) {
                    banId.innerHTML = "BANNED";
                } else {
                    banId.innerHTML = "Enabled";
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
    if (roleId.innerHTML == "User") {
        var action = "make";
        var newRole = 2;
    } else if (roleId.innerHTML == "Moderator") {
        action = "unmake";
        newRole = 1;
    } else if (roleId.innerHTML == "Admin") {
        alert("You cannot change the role of admin");
        throw "";
    }
    if (confirm("Are you sure you want to " + action + " moderator User with ID " + userId + " ?")) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.status == 500 && this.readyState == 4) {
                window.location.replace("../error/error_500.php");
            } else if (this.status == 400 && this.readyState == 4) {
                window.location.replace("../error/error_400.php");
            } else if (this.status == 200 && this.readyState == 4) {
                if (newRole == 2) {
                    roleId.innerHTML = "Moderator";
                } else {
                    roleId.innerHTML = "User";
                }
            }
        };
        xhttp.open("GET", "../../../controller/admin/users/moderator_user_controller.php?uid="
            + userId + "&nrole=" + newRole, true);
        xhttp.send();
    }
}