const module_2 = document.querySelector('.container_module_2')
if(module_2) {
    const mainContainer = document.querySelector('.wrapper_module_2')
    const buttonAdd = document.querySelector('.add_module_2')
    const slug = module_2.getAttribute('data-slug')
    
    buttonAdd.addEventListener('click', addNewRow)
    mainContainer.addEventListener('click', clickAction)

    function clickAction(event) {
        if(event.target.classList.contains('delete_module_2')) {
            event.target.parentElement.remove()
        } else if (event.target.classList.contains('up_module_2')) {
            if(event.target.parentElement.previousElementSibling) {
                event.target.parentElement.previousElementSibling.before(event.target.parentElement)
            } 
        } else if (event.target.classList.contains('bottom_module_2')) {
            if(event.target.parentElement.nextElementSibling) {
                event.target.parentElement.nextElementSibling.after(event.target.parentElement) 
            } 
        }
    }
    function addNewRow() {
        mainContainer.appendChild(createRow(slug))
    function createRow(slug) {

        const row = document.createElement('div')
        row.classList.add('row_module_2')
        
        const item_1 = document.createElement('div')
        item_1.classList.add('item_module_2')
        const input_1 = document.createElement('input')
        input_1.setAttribute('type', 'text')
        input_1.setAttribute('name', 'text_1_module_2_'+slug+'[]')
        item_1.appendChild(input_1)

        const item_2 = document.createElement('div')
        item_2.classList.add('item_module_2')
        const input_2 = document.createElement('input')
        input_2.setAttribute('type', 'text')
        input_2.setAttribute('name', 'text_2_module_2_'+slug+'[]')
        item_2.appendChild(input_2)
        
        const span_1 = document.createElement('span')
        span_1.classList.add('delete_module_2')
        span_1.textContent = 'X'

        const span_2 = document.createElement('span')
        span_2.classList.add('up_module_2')
        span_2.textContent = '⇑'

        const span_3 = document.createElement('span')
        span_3.classList.add('bottom_module_2')
        span_3.textContent = '⇓'

        row.appendChild(item_1)
        row.appendChild(item_2)
        row.appendChild(span_1)
        row.appendChild(span_2)
        row.appendChild(span_3)
        return row
        }
    }
}