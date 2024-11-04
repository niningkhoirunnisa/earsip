$(document).ready(function() {
    // Create carousel items dynamically
    const imageUrls = [
      "assets/img/c1.jpg", // Add more image URLs here
      // ...
    ];
  
    imageUrls.forEach((imageUrl, index) => {
      const carouselItem = `
        <div class="carousel-item ${index === 0 ? 'active' : ''}">
          <img src="${imageUrl}" class="img-fluid d-block w-100" alt="...">
        </div>
      `;
      $('.carousel-inner').append(carouselItem);
    });
  
    // Initialize and configure carousel
    $('#imageSlider').carousel({
      interval: 3000 // Change this value to adjust slide transition time (in milliseconds)
    });
  });
  