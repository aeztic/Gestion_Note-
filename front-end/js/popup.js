function openPopup(idNote, note) {
    document.getElementById("idNote").value = idNote;
    document.getElementById("note").value = note;
    document.getElementById("editPopup").style.display = "block";
  }
  
  function openPopup2() {
    document.getElementById("addPopup").style.display = "block";
  }
  
  function closePopup() {
    document.getElementById("editPopup").style.display = "none";
    document.getElementById("addPopup").style.display = "none";
  }
  
  document
    .getElementById("studentIdInput")
    .addEventListener("keypress", function (event) {
        if (event.key === "Enter") {
        event.preventDefault(); // Prevent form submission
        document.getElementById("searchForm").submit();
        }
    });