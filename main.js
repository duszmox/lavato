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

function confirmVote(i, cond=false) {
  z = (cond==true) ? "z" : "";
  Swal.fire({
    title: 'Biztos a'+z+' '+(i)+' osztályra szeretnél szavazni?',
    text: "Választásodat nem tudod majd visszavonni!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: "Nem, mégsem",
    confirmButtonText: 'Igen, biztos'
  }).then((result) => { 
    if (result.value) {
      Swal.fire(
        'Sikeres szavazás!',
        'Szavazatod elmenésre került!',
        'success'
      );
document.location.href = ""

    }
  })
}


