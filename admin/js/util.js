export const getProduct = async (route, productRoute) => {
    try {
        const validRoutes = ['makanan', 'sidedish', 'minuman'];
        if (!validRoutes.includes(productRoute)) {
            throw new Error('Invalid route');
        }

        const response = await fetch(`../model/model.php?route=${route}&product=${productRoute}`);
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        const data = await response.json();
        return data;
    } catch (error) {
        console.error('Error fetching data:', error);
    }
};

export const deleteProduct = async (route, productRoute, productId) => {
    try {
        const response = await fetch(`../model/model.php?route=${route}&product=${productRoute}&productId=${productId}`);
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        const { status } = await response.json();
        if (status == "success") {
            return true;
        }
    } catch (error) {
        console.error('Error deleting data:', error);
    }
};

export default { getProduct, deleteProduct};