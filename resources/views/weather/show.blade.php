<td>
    <a href="#" class="summit-link" data-summit="{{ $survey->summit }}">{{ $survey->summit }}</a>
</td>

<script>
    document.querySelectorAll('.summit-link').forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            const summitName = this.getAttribute('data-summit');

            // Κλήση στο API για να πάρουμε τα δεδομένα του summit
            fetch(`/api/summit/${summitName}`)
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    // Εδώ μπορείς να χειριστείς τα δεδομένα (π.χ. να τα εμφανίσεις σε πίνακα)
                    alert("Στοιχεία για την κορυφή: " + summitName);
                    console.log(data);
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert("Σφάλμα στην ανάκτηση δεδομσσσένων.");
                });
        });
    });
</script>




    <script>
        document.querySelectorAll('.summit-link').forEach(link => {
            link.addEventListener('click', function (e) {
                e.preventDefault();
                const summitName = this.getAttribute('data-summit');
    
                // Κλήση στο API για να πάρουμε τα δεδομένα του summit
                fetch(`/api/summit/${summitName}`)
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);  // Εδώ μπορείς να κάνεις ό,τι θέλεις με τα δεδομένα, π.χ. εμφάνιση σε άλλο μέρος του UI
    
                        // Παράδειγμα εμφάνισης σε πίνακα ή alert
                        alert("Στοιχεία για την κορυφή: " + summitName);
                        console.log(data);
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert("Σφάλμα στην ανάκτηση δεδομένων.");
                    });
            });
        });
    </script>
    
</x-app-layout>
