function getWindowWidth() {
    return document.body.clientWidth;
  }
          // Function to handle width change
  function handleWidthChange(entries) {
    for (let entry of entries) 
    {
      var containerWidth = entry.contentRect.width;
      console.log(containerWidth);
      if(containerWidth <= 104)
      {
          var margin = document.querySelectorAll('.margin-l');
          console.log(margin);
  
          if(margin.length > 0)
          {
            margin.forEach(function(margin) 
            {
              margin.classList.replace('margin-l', 'margin-low');
            });
          }
          
          
      // Trigger your custom event or perform actions here
      }
      else if(containerWidth <= 224)
      {
          console.log(containerWidth);
        var margin = document.querySelectorAll('.margin-low');
          console.log(margin);
  
          if(margin.length > 0)
          {
            margin.forEach(function(margin) 
            {
              margin.classList.replace('margin-low', 'margin-l');
            });
          }
          
      }
      var previousWidth = getWindowWidth();
      var card = document.querySelector('#card');
      var cardRect = card.getBoundingClientRect();
      var cardWidth = cardRect.width;
  
      console.log(cardWidth, previousWidth, containerWidth);
      
      card.style.marginRight = (previousWidth - cardWidth - containerWidth)/2 + 'px';
        console.log(((previousWidth - cardWidth) - containerWidth) / 2);
    }
  }
  
  // Select the container element
  const container = document.querySelector('.sidebar');
  
  // Create a new ResizeObserver instance
  var resizeObserver = new ResizeObserver(handleWidthChange);
  
  // Start observing the container for width changes
  resizeObserver.observe(container);

  