new Chart(document.getElementById('voteChart'), {
    type: 'bar',
    data: {
        labels: candidateNames,
        datasets: [{
            label: 'Votes',
            data: voteCounts
        }]
    }
});