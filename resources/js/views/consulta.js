document.addEventListener('DOMContentLoaded', () => {
    
    // Referencias al DOM
    const selectCarrera = document.getElementById('select-carrera');
    const selectSemestre = document.getElementById('select-semestre');
    const selectMateria = document.getElementById('select-materia');

    // --- EVENTO 1: CAMBIO DE CARRERA ---
    selectCarrera.addEventListener('change', async (e) => {
        const carreraId = e.target.value;

        // Limpiar selects dependientes
        resetSelect(selectSemestre, 'Cargando semestres...');
        resetSelect(selectMateria, 'Esperando semestre...');

        if (!carreraId) {
            resetSelect(selectSemestre, 'Esperando carrera...');
            return;
        }

        try {
            // Petición al Backend
            const response = await fetch(`/ajax/semestres/${carreraId}`);
            
            if (!response.ok) throw new Error('Error al cargar semestres');
            
            const semestres = await response.json();
            
            // Transformar [1, 2, 3] a objetos {id: 1, nombre: "Semestre 1"} para la función helper
            const datosSemestres = semestres.map(num => ({
                id: num, 
                nombre: `Semestre ${num}`
            }));

            populateSelect(selectSemestre, datosSemestres, 'Seleccione un semestre...');

        } catch (error) {
            console.error(error);
            resetSelect(selectSemestre, 'Error al cargar');
        }
    });

    // --- EVENTO 2: CAMBIO DE SEMESTRE ---
    selectSemestre.addEventListener('change', async (e) => {
        const semestre = e.target.value;
        const carreraId = selectCarrera.value;

        resetSelect(selectMateria, 'Cargando materias...');

        if (!semestre) {
            resetSelect(selectMateria, 'Esperando semestre...');
            return;
        }

        try {
            // Petición al Backend
            const response = await fetch(`/ajax/materias/${carreraId}/${semestre}`);
            
            if (!response.ok) throw new Error('Error al cargar materias');
            
            const materias = await response.json();
            
            // Aquí materias ya viene como [{id: 1, nombre: "Matemáticas"}, ...]
            populateSelect(selectMateria, materias, 'Todas las materias');

        } catch (error) {
            console.error(error);
            resetSelect(selectMateria, 'Error al cargar');
        }
    });

    // --- FUNCIONES HELPERS (Utilidades) ---
    
    function resetSelect(selectElement, placeholderText) {
        selectElement.innerHTML = '';
        selectElement.disabled = true;
        
        const defaultOption = document.createElement('option');
        defaultOption.value = "";
        defaultOption.textContent = placeholderText;
        selectElement.appendChild(defaultOption);
    }

    function populateSelect(selectElement, data, placeholderText) {
        selectElement.innerHTML = ''; // Limpiar previo
        selectElement.disabled = false;

        // Opción por defecto
        const defaultOption = document.createElement('option');
        defaultOption.value = "";
        defaultOption.textContent = placeholderText;
        selectElement.appendChild(defaultOption);

        // Llenar opciones
        data.forEach(item => {
            const option = document.createElement('option');
            option.value = item.id;
            option.textContent = item.nombre;
            selectElement.appendChild(option);
        });
    }

});