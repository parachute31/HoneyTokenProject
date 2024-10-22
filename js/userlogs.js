
document.addEventListener("DOMContentLoaded", () => {
  console.log("Attempting to fetch logs from server...");

  fetch('../php/get_userlogs.php')
      .then(response => {
          console.log("Response status:", response.status);
          if (!response.ok) {
              console.error("Failed to fetch logs. Status:", response.status);
              throw new Error("Network response was not ok");
          }
          return response.json();
      })
      .then(data => {
          console.log("Logs data received:", data);
          if (data.length === 0) {
              console.warn("No logs found in the data.");
          }
          const logTableBody = document.querySelector('#logTable tbody');

          data.forEach(log => {
              console.log("Adding log to table:", log);
              const row = document.createElement("tr");
              row.insertCell(0).innerText = log.id ? log.id : " "; // Using "N/A" if id is not available
              row.insertCell(1).innerText = log.username ? log.username : " ";
              row.insertCell(2).innerText = log.button_clicked ? log.button_clicked : " ";
              row.insertCell(3).innerText = log.bot_name ? log.bot_name : " ";
              row.insertCell(4).innerText = log.downloaded_file ? log.downloaded_file : " ";
              row.insertCell(5).innerText = log.city ? log.city : " ";
              row.insertCell(6).innerText = log.country ? log.country : " ";
              row.insertCell(7).innerText = log.timestamp ? log.timestamp : " ";
              logTableBody.appendChild(row);
          });
      })
      .catch(error => {
          console.error("Error fetching logs:", error);
      });
});
