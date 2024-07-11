import {getProduct, deleteProduct} from './util.js';

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
            }],
    data: []
    }
).render(document.getElementById("wrapper"));

const onSelectChange = async () => {
    const select = document.getElementById("jenis-produk");
    const selected = select.options[select.selectedIndex].value;
    const {message, data} = await getProduct("get", selected);
    if (message == "No data found") return;
    dataArray = data.map((dataObject) => Object.values(dataObject));
    table.updateConfig({data: dataArray}).forceRender();
}

const onAddButtonClick = () => {
    const select = document.getElementById("jenis-produk");
    const selected = select.options[select.selectedIndex].value;
}

const onDeleteProductClick = async (productId) => {
    const select = document.getElementById("jenis-produk");
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
  