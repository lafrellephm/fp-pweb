document.addEventListener('DOMContentLoaded', function() {
    const typeSelect = document.getElementById('letter_type');
    const assignmentFields = document.getElementById('assignment-fields');

    if (!typeSelect || !assignmentFields) return;

    function toggleFields() {
        if (typeSelect.value === 'assignment') {
            assignmentFields.style.display = 'block';
        } else {
            assignmentFields.style.display = 'none';
        }
    }

    toggleFields();
    typeSelect.addEventListener('change', toggleFields);
});
