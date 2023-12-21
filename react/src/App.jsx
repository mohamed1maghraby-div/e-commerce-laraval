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
        </Routes>
      </BrowserRouter>
      <Footer />
    </div>
  )
}

export default App
