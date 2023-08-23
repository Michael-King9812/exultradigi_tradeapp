window.onload = function() {
    const table = document.getElementById("withdrawals-table");
  
    // Generate 30 random transactions with shuffled statuses
    const transactions = [];
    for (let i = 0; i < 18; i++) {
      transactions.push({
        id: Math.floor(Math.random() * 90000000) + 10000000,
        wallet: Math.random().toString(36).substring(2, 14) + Math.random().toString(36).substring(2, 14),
        amount: Math.floor(Math.random() * 450000) + 300,
        status: "success"
      });
    }
    for (let i = 0; i < 8; i++) {
      transactions.push({
        id: Math.floor(Math.random() * 90000000) + 10000000,
        wallet: Math.random().toString(36).substring(2, 14) + Math.random().toString(36).substring(2, 14),
        amount: Math.floor(Math.random() * 450000) + 300,
        status: "pending"
      });
    }
    for (let i = 0; i < 4; i++) {
      transactions.push({
        id: Math.floor(Math.random() * 90000000) + 10000000,
        wallet: Math.random().toString(36).substring(2, 14) + Math.random().toString(36).substring(2, 14),
        amount: Math.floor(Math.random() * 450000) + 300,
        status: "failed"
      });
    }
    transactions.sort(() => Math.random() - 0.5); // Shuffle the array
  
    // Create a new table row for each transaction
    transactions.forEach((transaction) => {
      const row = table.insertRow(-1);
      const idCell = row.insertCell(0);
      const walletCell = row.insertCell(1);
      const amountCell = row.insertCell(2);
      const statusCell = row.insertCell(3);
      idCell.innerHTML = transaction.id;
      walletCell.innerHTML = transaction.wallet;
      amountCell.innerHTML = `$${transaction.amount}`;
      statusCell.innerHTML = transaction.status;
      statusCell.classList.add(transaction.status);
    });
  };
  