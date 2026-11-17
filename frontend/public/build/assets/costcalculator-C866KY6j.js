document.addEventListener(`DOMContentLoaded`,function(){let e=document.querySelectorAll(`.calculator-option`),t=document.querySelectorAll(`.calculator-panel`);e.forEach(n=>{n.addEventListener(`click`,function(){let n=this.dataset.calculator;e.forEach(e=>{e.classList.remove(`active`)}),this.classList.add(`active`),t.forEach(e=>{e.classList.add(`d-none`)});let r=document.getElementById(n);r&&r.classList.remove(`d-none`)})})}),document.addEventListener(`DOMContentLoaded`,function(){let e={production:`
            <td>
                <input class="form-control" placeholder="Material name">
            </td>
            <td>
                <input type="number" class="form-control" placeholder="0">
            </td>
            <td>
                <select class="form-select">
                    <option>Kg</option>
                    <option>Gram</option>
                    <option>Liter</option>
                    <option>ML</option>
                    <option>Pcs</option>
                    <option>Pack</option>
                </select>
            </td>
            <td>
                <input type="number" class="form-control" placeholder="0">
            </td>
            <td class="cost-value">Rp 0</td>
            <td>
                <button type="button" class="btn-delete">
                    <i class="bi bi-trash"></i>
                </button>
            </td>
        `,resell:`
            <td>
                <input class="form-control" placeholder="Cost description">
            </td>
            <td>
                <input type="number" class="form-control" placeholder="0">
            </td>
            <td>
                <button type="button" class="btn-delete">
                    <i class="bi bi-trash"></i>
                </button>
            </td>
        `,custom:`
            <td>
                <input class="form-control" placeholder="Component name">
            </td>
            <td>
                <input type="number" class="form-control" placeholder="0">
            </td>
            <td>
                <input type="number" class="form-control" placeholder="0">
            </td>
            <td class="cost-value">Rp 0</td>
            <td>
                <button type="button" class="btn-delete">
                    <i class="bi bi-trash"></i>
                </button>
            </td>
        `},t={production:`production-materials`,resell:`resell-costs`,custom:`custom-components`};document.addEventListener(`click`,function(n){let r=n.target.closest(`[data-add-row]`);if(r){let n=r.dataset.addRow,i=document.getElementById(t[n]);if(!i||!e[n])return;let a=document.createElement(`tr`);a.innerHTML=e[n],i.appendChild(a)}let i=n.target.closest(`.btn-delete`);if(i){let e=i.closest(`tr`);e&&e.remove()}})});