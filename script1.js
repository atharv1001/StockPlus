function searchStock() {
    // Get the stock symbol from the input field
    var stockSymbol = document.getElementById('stockInput').value;
  
    // Validate if the input is not empty
    if (stockSymbol.trim() === '') {
      alert('Please enter a stock symbol');
      return;
    }
  
    // Clear the previous chart if any
    document.getElementById('chartContainer').innerHTML = '';
  
    // Create an iframe for TradingView chart
    var iframe = document.createElement('iframe');
    iframe.src = 'https://www.tradingview.com/symbols/' + stockSymbol + '/';
    iframe.width = '100%';
    iframe.height = '100%';
  
    // Append the iframe to the chart container
    document.getElementById('chartContainer').appendChild(iframe);
  }
  