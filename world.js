// event listener for button
const btn = document.getElementById('lookup');
btn.addEventListener('click', () => {
    const country = document.getElementById('country').value;
    const url = `world.php?country=${encodeURIComponent(country)}`;
        fetch(url)
        .then(response => response.text())
        .then(data => {
            document.getElementById('result').innerHTML = data;
    })
    .catch(error => console.error('Error:', error));

});