function sendAjaxRequest() {
  const heightMeters = parseFloat(
    document.querySelector('input[name="height-meters"]').value || 0
  );
  const heightCentimeters = parseFloat(
    document.querySelector('input[name="height-centimeters"]').value || 0
  );
  const heightMillimeters = parseFloat(
    document.querySelector('input[name="height-millimeters"]').value || 0
  );

  const widthMeters = parseFloat(
    document.querySelector('input[name="width-meters"]').value || 0
  );
  const widthCentimeters = parseFloat(
    document.querySelector('input[name="width-centimeters"]').value || 0
  );
  const widthMillimeters = parseFloat(
    document.querySelector('input[name="width-millimeters"]').value || 0
  );

  const thickness = parseFloat(
    document.querySelector('input[name="thickness"]').value || 0
  );
  const borderRadius = parseFloat(
    document.querySelector('input[name="border_radius"]').value || 0
  );

  const xhr = new XMLHttpRequest();
  xhr.open("POST", "components/calculatePrice.php", true);

  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  const data = `heightMeters=${heightMeters}&heightCentimeters=${heightCentimeters}&heightMillimeters=${heightMillimeters}&widthMeters=${widthMeters}&widthCentimeters=${widthCentimeters}&widthMillimeters=${widthMillimeters}&thickness=${thickness}&borderRadius=${borderRadius}`;
  xhr.send(data);

  xhr.onload = function () {
    if (xhr.status === 200) {
      // Debugging the response
      console.log("Response received: ", xhr.responseText);
      // Updating the UI
      document.getElementById(
        "price-display"
      ).innerText = `Price: $${xhr.responseText}`;
    } else {
      console.error("Error in AJAX Request", xhr.status, xhr.statusText);
    }
  };
}
