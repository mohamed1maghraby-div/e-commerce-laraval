import Slider from '../../Components/Home/Slider';
import HomeCategory from '../../Components/Home/HomeCategory';
import CardProductsContainer from '../../Components/Products/CardProductsContainer';
import DiscountSection from '../../Components/Home/DiscountSection';
import BrandFeatured from '../../Components/Brand/BrandFeatured';
import ViewHomeProductsHook from '../../hook/product/view-homeproducts-hook';

const HomePage = () => {

    const [items] = ViewHomeProductsHook();

    return (
        <div className="font" style={{ minHeight:'670px' }}>
            <Slider />
            <HomeCategory />
            <CardProductsContainer products={items} title="الأكثر مبيعا" btntitle="المزيد" pathText='/products'/>
            <DiscountSection />
            <CardProductsContainer products={items} title="احدث الأزياء" btntitle="المزيد" pathText='/products'/>
            <BrandFeatured title="اشهر الماركات" btntitle="المزيد"/>
        </div>
    )
}

export default HomePage