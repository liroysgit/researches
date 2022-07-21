window.onload = function () {
    var upLink = document.querySelectorAll(".up");
    for (var i = 0; i < upLink.length; i++) {
        upLink[i].addEventListener('click', function () {
            var wrapper = this.parentElement.parentElement;

            if (wrapper.previousElementSibling)
                wrapper.parentNode.insertBefore(wrapper, wrapper.previousElementSibling);
        });
    }

    var downLink = document.querySelectorAll(".down");

    for (var i = 0; i < downLink.length; i++) {
        downLink[i].addEventListener('click', function () {
            var wrapper = this.parentElement.parentElement;

            if (wrapper.nextElementSibling)
                wrapper.parentNode.insertBefore(wrapper.nextElementSibling, wrapper);
        });
    }

}

function toggleEditButtons(buttonElement) {
    if (buttonElement.id === "edit_order_span") {
        let span = document.getElementById('save_or_cancel_edit_span');
        span.style.display = 'inline';
        buttonElement.style.display = 'none';
        document.querySelectorAll('.change_order_buttons').forEach(function (el) {
            el.style.display = 'inline';
        });
    } else {
        let editOrderSpan = document.getElementById('edit_order_span');
        let SaveOrCancelEditSpan = document.getElementById('save_or_cancel_edit_span');
        editOrderSpan.style.display = 'inline';
        SaveOrCancelEditSpan.style.display = 'none';
        document.querySelectorAll('.change_order_buttons').forEach(function (el) {
            el.style.display = 'none';
        });

        if (buttonElement.id === "save_new_order_button") {
            let orderList = document.querySelector('#order_list');
            let researchId = document.querySelector('#research_card').dataset.researchId;
            let listItems = orderList.children;
            let obj = {};
            obj["0"] = researchId;
            for (let i = 0; i < listItems.length; i++) {
                obj[(i + 1).toString()] = listItems[i].dataset.researcherId;
            }
            saveNewOrder(obj);
        }
    }
}

function saveNewOrder(obj) {
    const url = "save_new_order.php";
    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(obj)
    }).then(
        //response => response.text()
    ).then(
        //html => console.log(html)
    );
}

