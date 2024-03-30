// confirm order
$(document).on("click", "#confirm", function (e) {
    e.preventDefault();
    let link = $(this).attr("href");
    Swal.fire({
        title: "Are you sure to confirm this order?",
        text: "Once Confirmed, You will not be able to pending again!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, Confirm!",
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = link;
            Swal.fire({
                title: "Confirmed!",
                text: "Confirmed Changed",
                icon: "success",
            });
        }
    });
});

$(document).on("click", "#delete", function (e) {
    e.preventDefault();
    let link = $(this).attr("href");
    Swal.fire({
        title: "Are you sure?",
        text: "Deleted this data!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = link;
            Swal.fire({
                title: "Deleted!",
                text: "Your data has been deleted.",
                icon: "success",
            });
        }
    });
});
