import {getProduct, deleteProduct} from 'js/util.js';

const select = document.getElementById("jenis-produk");
const addNewProductButton = document.getElementById("add-product-button");
let dataArray;

const table = new gridjs.Grid({
    sort: true,
    search: true,
    columns: [
            {
                name: "id",
                hidden: true
            },
            "Nama Produk",
            "Harga",
            {
                name: "keterangan",
                hidden: true
            },
            {
                name: "img",
                hidden: true
            },
            {
                name: "Aksi",
                formatter: (_, row) => {
                    return [gridjs.h('button', {
                      className: 'color: red, edit-button',
                      onClick: () => alert(`Editing "${row.cells[0].data}" "${row.cells[1].data}"`)
                    }, 'Edit'),
                    gridjs.h('button', {
                        className: 'color: red delete-button',
                        onClick: () => onDeleteProductClick(row.cells[0].data)
                      }, 'Hapus')];
                  }
            }
    ],
    data: []
}).render(document.getElementById("wrapper"));

const onSelectChange = async () => {
    const selected = select.options[select.selectedIndex].value;
    const {message, data} = await getProduct("get", selected);
    if (message === "No data found") return;
    dataArray = data.map((dataObject) => Object.values(dataObject));
    table.updateConfig({data: dataArray}).forceRender();
}

const onEditProductClick = async (productId, productType) => {
    // Fetch product data
    const response = await fetch(`process_update.php?id=${productId}&type=${productType}`);
    const {status, data} = await response.json();

    if (status === 'success') {
        // Populate modal with product data
        document.getElementById('update-product-id').value = data.id;
        document.getElementById('update-product-type').value = productType;
        document.getElementById('update-product-name').value = data.name;
        document.getElementById('update-product-price').value = data.price;
        document.getElementById('update-product-description').value = data.description;
        document.getElementById('update-product-category').value = data.category;

        // Show modal
        const updateModal = new bootstrap.Modal(document.getElementById('updateProductModal'));
        updateModal.show();
    } else {
        alert('Failed to fetch product data');
    }
}

const onDeleteProductClick = async (productId) => {
    const selected = select.options[select.selectedIndex].value;
    const result = await deleteProduct("delete", selected, productId);
    if (result) {
        const updatedData = dataArray.filter((data) => data[0] != productId);
        dataArray = updatedData;
        table.updateConfig({data: dataArray}).forceRender();
    }
}

select.addEventListener('change', onSelectChange);
addNewProductButton.addEventListener("click", onAddButtonClick);