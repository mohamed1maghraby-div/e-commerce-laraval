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
        </Routes>
      </BrowserRouter>
      <Footer />
    </div>
  )
}

export default App
