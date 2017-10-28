function changeStatus(orderId) {
    var xhttp = new XMLHttpRequest();
    var newStatus = document.getElementById("newStatusId-" + orderId).value;

    xhttp.onreadystatechange = function () {
        if (this.status == 200 && this.readyState == 4) {
            var status = document.getElementById("statusId-" + orderId);
            status.innerHTML = newStatus;
        }
    };
    xhttp.open("GET", "../../../controller/admin/orders/status_order_controller.php?oid=" + orderId + "&ns=" + newStatus, true);
    xhttp.send();
}