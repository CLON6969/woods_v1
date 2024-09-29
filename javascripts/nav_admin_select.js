function populateNavLinkName() {
    var selectElement = document.getElementById("navLinkSelect");
    var selectedOption = selectElement.options[selectElement.selectedIndex];
    var navLinkNameInput = document.getElementById("navLinkName");

    navLinkNameInput.value = selectedOption.text;
}
