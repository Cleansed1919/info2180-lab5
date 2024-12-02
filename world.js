document.addEventListener("DOMContentLoaded", function() {
    console.log("Page loaded... ");
    let lookupbtn = document.getElementById("lookup");
    let lookupcitiesbtn = document.getElementById("lookupcities");
    lookupbtn.onclick = function() {
        console.log("Lookup function activated");
        let input = document.getElementById("country").value;
        console.log("input: " + input);
        fetch(`http://localhost/info2180-lab5/world.php?country=${encodeURIComponent(input)}`,{
            method:"GET",
            headers: {"Content-Type": "application/x-www-form-urlencoded"}
        })
        .then(response => {
            if (response.ok) {
                return response.text();
            }
            else {
                return Promise.reject("An error has occured!")
            }
        })
        .then(data => {
            let result = document.getElementById("result");
            result.innerHTML = data;
        })
        .catch(error => {
            console.log("There was an error: " + error);
        });
    }
    lookupcitiesbtn.onclick = function() {
        console.log("Lookup Cities function activated");
        let input = document.getElementById("country").value;
        console.log("input: " + input);
        fetch(`http://localhost/info2180-lab5/world.php?country=${encodeURIComponent(input)}&lookup=cities`,{
            method:"GET",
            headers: {"Content-Type": "application/x-www-form-urlencoded"}
        })
        .then(response => {
            if (response.ok) {
                return response.text();
            }
            else {
                return Promise.reject("An error has occured!")
            }
        })
        .then(data => {
            let result = document.getElementById("result");
            result.innerHTML = data;
        })
        .catch(error => {
            console.log("There was an error: " + error);
        });
    }
})