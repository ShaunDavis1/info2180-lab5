// event listener for lookup button
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

// event listener for lookup cities button
const btn2 = document.getElementById('lookupCities');
btn2.addEventListener('click', () => {
    const country = document.getElementById('country').value;

    const url = `world.php?country=${encodeURIComponent(country)}&lookup=cities`;

        fetch(url)
        .then(response => response.text())
        .then(data => {
            document.getElementById('result').innerHTML = data;
        })

        .catch(error => console.error('Error:', error));
});