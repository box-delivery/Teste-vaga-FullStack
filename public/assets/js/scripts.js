M.AutoInit();

const loader = document.querySelector(".preloader");

const addToFavorites = id => {
    $.ajax({
        url: window.location.origin + '/addToFavorites/' + id,
        method: "POST",
        processData: false,
        beforeSend: () =>{
            preloader(true);
        },
        statusCode: {
            200: () => {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    text: 'Added to favorites!',
                        showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                });
                window.location.reload();
            },
            400: () => {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'error',
                    text: 'Ops.. Try again!',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                });
            }
        }
    }).done(() => {
        preloader(false);
    });
}
const removeFromFavorites = id => {
    $.ajax({
        url: window.location.origin + '/removeFromFavorites/' + id,
        method: "POST",
        processData: false,
        beforeSend: () =>{
            preloader(true);
        },
        statusCode: {
            200: () => {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    text: 'Removed from favorites!',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                });
                window.location.reload();
            },
            400: () => {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'error',
                    text: 'Ops.. Try again!',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                });
            }
        }
    }).done(() => {
        preloader(false);
    });
}

const preloader = status => status ? loader.style.display = 'block' : loader.style.display = 'none';
