// JavaScript code for smoother animation
const svg = document.getElementById('a');

let rotation = 0;

function animate() {
    rotation += 1.5; // Adjust rotation speed as needed
    svg.style.transform = `rotate(${rotation}deg)`;

    requestAnimationFrame(animate);
}

animate();
