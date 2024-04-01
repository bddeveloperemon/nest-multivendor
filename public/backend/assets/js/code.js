// processing order
$(document).on("click", "#processing", function (e) {
    e.preventDefault();
    let link = $(this).attr("href");
    Swal.fire({
        title: "Are you sure to process this order?",
        text: "Once Processing, You will not be able to process again!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, Processing!",
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = link;
            Swal.fire({
                title: "Processing!",
                text: "Processing Changed",
                icon: "success",
            });
        }
    });
});
// processing order
$(document).on("click", "#deliverd", function (e) {
    e.preventDefault();
    let link = $(this).attr("href");
    Swal.fire({
        title: "Are you sure to Deliverd this order?",
        text: "Once Deliverd, You will not be able to process again!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, Deliverd!",
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = link;
            Swal.fire({
                title: "Deliverd!",
                text: "Deliverd Changed",
                icon: "success",
            });
        }
    });
});

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

// return request approv
$(document).on("click", "#approve", function (e) {
    e.preventDefault();
    let link = $(this).attr("href");
    Swal.fire({
        title: "Are you sure to approve?",
        text: "Return Order Approve",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, Approved!",
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = link;
            Swal.fire({
                title: "Approved!",
                text: "Approved Changed",
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
