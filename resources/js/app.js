import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('DOMContentLoaded', function() {
    const letterType = document.getElementById('letter_type');
    const assignmentFields = document.getElementById('assignment-fields');

    if (letterType && assignmentFields) {
        function toggleAssignmentFields() {
            if (letterType.value === 'assignment') {
                assignmentFields.style.display = 'block';
            } else {
                assignmentFields.style.display = 'none';
            }
        }

        letterType.addEventListener('change', toggleAssignmentFields);
        toggleAssignmentFields(); // run on page load
    }
});
