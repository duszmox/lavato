function hideForm() {
    document.getElementById("code-form").style.display="none";
};
function voteInfo() {
    Swal.fire(
        'Válassz osztályt!',
        '',
        'info'
      )
}
function notRealCode() {
    Swal.fire({
        title: 'Nem létező kódot próbálsz használni!',
        icon: 'error',
        html:
          'Nézd meg, nem-e ütötted el, vagy használj másik kódot!',
        focusConfirm: false,
        confirmButtonText: 'Vissza'
    }).then((result) => {
      if (result.value) {
        window.location.href = "vote.php";
      }
    })
       
}

function visibleForm() {
    document.getElementById("code-form").style.display="";
};
