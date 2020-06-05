function voteInfo() {
  Swal.fire("Válassz osztályt!", "", "info");
}

function notRealCode() {
  Swal.fire({
    title: "Nem létező kódot próbálsz használni!",
    icon: "error",
    html: "Nézd meg, nem-e ütötted el, vagy használj másik kódot!",
    focusConfirm: false,
    confirmButtonText: "Vissza",
  }).then((result) => {
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
    confirmButtonText: "Igen, biztos",
  }).then((result) => {
    if (result.value) {
      window.location.href = "upload_vote.php?hash=" + hash + "&class=" + i;
    }
  });
}

function successfulVote() {
  Swal.fire({
    title: "Sikeres szavazás!",
    icon: "success",
    html: "Szavazatod elmentésre került",
    focusConfirm: false,
    confirmButtonText: "Ok",
  }).then((result) => {
    if (result.value) {
      window.location.href = "index.php";
    }
  });
}

function codeAlreadyActivated() {
  Swal.fire({
    title: "Ezt a kódot már használták egyszer!",
    icon: "error",
    html: "Ezt a kódot már egyszer beolvasta valaki.",
    focusConfirm: false,
    confirmButtonText: "Vissza",
  }).then((result) => {
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
    confirmButtonText: "Ok",
  }).then((result) => {
    if (result.value) {
      window.location.replace("index.php");
    }
  });
}
function cannotLogin() {
  Swal.fire({
    title: "Sikertelen bejelentkezés",
    text: "Hibás felhasználónév vagy jelszó! Próbáld újra!",
    icon: "error",
    confirmButtonColor: "#28a745",
    confirmButtonText: "Ok",
  });
}
function alreadyUsedUsername() {
  Swal.fire({
    title: "Ez a felhasználónév már foglalt",
    text: "Nem sikerült regisztrálni, mert már van ilyen felhasználó",
    icon: "error",
    confirmButtonColor: "#28a745",
    confirmButtonText: "Ok",
  });
}
function successfulRegistration() {
  Swal.fire({
    title: "Sikeresen regisztráltál egy új felasználót",
    text: "",
    icon: "success",
    confirmButtonColor: "#28a745",
    confirmButtonText: "Ok",
  });
}
function successfulCodeGen($number) {
  Swal.fire({
    title: "Sikeresen legeneráltál " + $number + " kódot!",
    text: "",
    icon: "success",
    confirmButtonColor: "#28a745",
    confirmButtonText: "Ok",
  }).then((result) => {
    if (result.value) {
      window.location.replace("admin.php");
    }
  });
}
function wait(ms) {
  var d = new Date();
  var d2 = null;
  do {
    d2 = new Date();
  } while (d2 - d < ms);
}
function vote_is_not_open() {
  Swal.fire({
    title: "Nincs megnyitva még a szavazás!",
    text:
      "Várd meg amíg a szavazás megnyílik, utána oldvasd be mégegyszer a kódot!",
    icon: "error",
    confirmButtonColor: "#28a745",
    confirmButtonText: "Ok",
  });
}
function successfulPostUpload() {
  Swal.fire({
    title: "Sikeresen közzétetted a hírt!",
    text: "",
    icon: "success",
    confirmButtonColor: "#28a745",
    confirmButtonText: "Ok",
  }).then((result) => {
    if (result.value) {
      window.location.replace("index.php");
    }
  });
}
