document.addEventListener("DOMContentLoaded", function () {
  // Benutzerdaten aus dem localStorage abrufen
  const user = JSON.parse(localStorage.getItem("user"));

  // Überprüfen, ob die Benutzerdaten im localStorage vorhanden sind
  if (user) {
    // Setzt die Eingabewerte für Vorname, Nachname und E-Mail
    document.getElementById("firstName").value = user.first_name || "";
    document.getElementById("lastName").value = user.last_name || "";
    document.getElementById("email").value = user.email || "";

    const userDropdown = document.getElementById("userDropdown");

    // Ersetzt das Symbol mit dem vollständigen Namen des Benutzers und fügt eine Logout-Option hinzu
    userDropdown.innerHTML = `
  <a class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" role="button" aria-haspopup="true" style="text-decoration: none; color: black;">
${user.first_name} ${user.last_name}
</a>
<ul class="dropdown-menu">
    <li><a class="dropdown-item" href="#" id="logoutBtn">Logout</a></li>
</ul>
`;
  }

  // Handhabung des Klicks auf die Logout-Schaltfläche
  document.getElementById("logoutBtn")?.addEventListener("click", function () {
    // Entfernt die Benutzerdaten aus dem localStorage
    localStorage.removeItem("user");

    // Leitet nach dem Ausloggen zur Login-Seite weiter
    window.location.href = "login.php";
  });
});

//Zahlungsformular-Validierung
document
  .getElementById("paymentForm")
  .addEventListener("submit", function (event) {
    event.preventDefault(); // Verhindert die Standard-Formularübermittlung

    // Löscht vorherige Fehlermeldungen
    document.querySelectorAll(".error-message").forEach((error) => {
      error.textContent = "";
    });

    // Ruft die Formularwerte ab
    const cardName = document.getElementById("cardName").value.trim();
    const cardNum = document.getElementById("cardNum").value.trim();
    const expMonth = document.getElementById("expMonth").value.trim();
    const expYear = document.getElementById("expYear").value.trim();
    const cvv = document.getElementById("cvv").value.trim();

    let isValid = true;

    // Führt die Validierung für jedes Feld durch
    if (!cardName) {
      document.getElementById("cardNameError").textContent =
        "Der Name auf der Karte ist erforderlich.";
      isValid = false;
    }

    if (!cardNum) {
      document.getElementById("cardNumError").textContent =
        "Die Kartennummer ist erforderlich.";
      isValid = false;
    } else if (!/^\d{4}-\d{4}-\d{4}-\d{4}$/.test(cardNum)) {
      document.getElementById("cardNumError").textContent =
        "Das Format der Kartennummer ist ungültig.";
      isValid = false;
    }

    if (!expMonth) {
      document.getElementById("expMonthError").textContent =
        "Der Ablaufmonat ist erforderlich.";
      isValid = false;
    }

    if (!expYear) {
      document.getElementById("expYearError").textContent =
        "Das Ablaufjahr ist erforderlich.";
      isValid = false;
    }

    if (!cvv) {
      document.getElementById("cvvError").textContent =
        "Der CVV ist erforderlich.";
      isValid = false;
    } else if (cvv.length !== 3) {
      document.getElementById("cvvError").textContent =
        "Der CVV muss 3 Stellen haben.";
      isValid = false;
    }

    // Wenn das Formular gültig ist, wird das Modal angezeigt
    if (isValid) {
      var paymentModal = new bootstrap.Modal(
        document.getElementById("paymentModal")
      );
      paymentModal.show();
    }
  });
