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

function changeRole() {

}