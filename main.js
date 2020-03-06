function voteInfo() {
  Swal.fire("Válassz osztályt!", "", "info");
}

function notRealCode() {
  Swal.fire({
    title: "Nem létező kódot próbálsz használni!",
    icon: "error",
    html: "Nézd meg, nem-e ütötted el, vagy használj másik kódot!",
    focusConfirm: false,
    confirmButtonText: "Vissza"
  }).then(result => {
    if (result.value) {
      window.location.href = "vote.php";
    }
  });
}

function visibleForm() {
  document.getElementById("code-form").style.display = "";
}

function confirmVote(i, cond = false, hash) {
  z = cond == true ? "z" : "";
  Swal.fire({
    title: "Biztos a" + z + " " + i + " osztályra szeretnél szavazni?",
    text: "Választásodat nem tudod majd visszavonni!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    cancelButtonText: "Nem, mégsem",
    confirmButtonText: "Igen, biztos"
  }).then(result => {
    if (result.value) {
      window.location.href =
        "/lavato/upload_vote.php?hash=" + hash + "&class=" + i;
    }
  });
}

function successfulVote() {
  Swal.fire({
    title: "Sikeres szavazás!",
    icon: "success",
    html: "Szavazatod elmentésre került",
    focusConfirm: false,
    confirmButtonText: "Ok"
  }).then(result => {
    if (result.value) {
      window.location.href = "vote.php";
    }
  });
}

function codeAlreadyActivated() {
  Swal.fire({
    title: "Ezt a kódot már használták egyszer!",
    icon: "error",
    html: "Ezt a kódot már egyszer beolvasta valaki.",
    focusConfirm: false,
    confirmButtonText: "Vissza"
  }).then(result => {
    if (result.value) {
      window.location.href = "vote.php";
    }
  });
}

  
function successfulLogin() {
  Swal.fire({
    title: "Sikeresen bejelentkeztél",
    text: "",
    icon: "success",
    confirmButtonColor: "#28a745",
    confirmButtonText: "Ok"
  }).then(result => {
    if (result.value) {
      window.location.replace("/lavato/");
    }
  });
}
function cannotLogin() {
  Swal.fire({
    title: "Sikertelen bejelentkezés",
    text: "Hibás felhasználónév vagy jelszó! Próbáld újra!",
    icon: "error",
    confirmButtonColor: "#28a745",
    confirmButtonText: "Ok"
  });
}
function successfulCodeGen($number) {
  Swal.fire({
    title: "Sikeresen legeneráltál "+$number+" kódot!",
    text: "",
    icon: "success",
    confirmButtonColor: "#28a745",
    confirmButtonText: "Ok"
  }).then(result => {
    if (result.value) {
      window.location.replace("/lavato/hashgen.php");
    }
  });
}
function wait(ms)
{
var d = new Date();
var d2 = null;
do { d2 = new Date(); }
while(d2-d < ms);
}
