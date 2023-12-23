import Footer from "./Components/Utility/Footer";
import NavBarLogin from "./Components/Utility/NavBarLogin";
import HomePage from "./Page/Home/HomePage";
import { BrowserRouter, Routes, Route } from "react-router-dom";
import LoginPage from "./Page/Auth/LoginPage";
import RegisterPage from "./Page/Auth/RegisterPage";
import AllBrandPage from "./Page/Brand/AllBrandPage";
import AllCategoryPage from "./Page/Category/AllCategoryPage";
import ShopProductsPage from "./Page/Products/ShopProductsPage";
import ProductDetalisPage from "./Page/Products/ProductDetalisPage";
import CartPage from "./Page/Cart/CartPage";
import ChoosePayMethodPage from "./Page/Checkout/ChoosePayMethodPage";
import AdminAllProductPage from "./Page/Admin/AdminAllProductPage";
import AdminAllOrdersPage from "./Page/Admin/AdminAllOrdersPage";
import AdminOrdersDetaliPage from "./Page/Admin/AdminOrdersDetalisPage";
import AdminAddBrandPage from "./Page/Admin/AdminAddBrandPage";
import AdminAddCategoryPage from "./Page/Admin/AdminAddCategoryPage";
import AdminAddSubCategoryPage from "./Page/Admin/AdminAddSubCategoryPage";
import AdminAddProductPage from "./Page/Admin/AdminAddProductPage";
import UserAllOrdersPage from "./Page/User/UserAllOrdersPage";
import UserFavoriteProductsPage from "./Page/User/UserFavoriteProductsPage";


function App() {

  return (
    <div className="font">
    <NavBarLogin />
      <BrowserRouter>
        <Routes>
          <Route index element={<HomePage />}/>
          <Route path="/login" element={<LoginPage />}/>
          <Route path="/register" element={<RegisterPage />}/>
          <Route path="/allcategory" element={<AllCategoryPage />}/>
          <Route path="/AllBrand" element={<AllBrandPage />}/>
          <Route path="/products" element={<ShopProductsPage />}/>
          <Route path="/products/:id" element={<ProductDetalisPage />}/>
          <Route path="/cart" element={<CartPage />}/>
          <Route path="/order/paymethod" element={<ChoosePayMethodPage />}/>

          {/* Admin */}
          <Route path="/admin/allproducts" element={<AdminAllProductPage />}/>
          <Route path="/admin/allorders" element={<AdminAllOrdersPage />}/>
          <Route path="/admin/orders/:id" element={<AdminOrdersDetaliPage />}/>
          <Route path="/admin/addbrand" element={<AdminAddBrandPage />}/>
          <Route path="/admin/addcategory" element={<AdminAddCategoryPage />}/>
          <Route path="/admin/addsubcategory" element={<AdminAddSubCategoryPage />}/>
          <Route path="/admin/addproduct" element={<AdminAddProductPage />}/>

          {/* user */}
          <Route path="/user/allorders" element={<UserAllOrdersPage />}/>
          <Route path="/user/favoriteproducts" element={<UserFavoriteProductsPage />}/>
        </Routes>
      </BrowserRouter>
      <Footer />
    </div>
  )
}

export default App
