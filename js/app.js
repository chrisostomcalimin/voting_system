function loadVotingStats(){

    fetch("progress.php")
    .then(response => response.json())
    .then(data => {

        document.getElementById("registered")
            .innerText = data.students;

        document.getElementById("votes")
            .innerText = data.votes;

        document.getElementById("percentage")
            .innerText = data.percentage + "%";

        document.getElementById("progressBar")
            .style.width = data.percentage + "%";
    });
}

loadVotingStats();

setInterval(loadVotingStats, 3000);