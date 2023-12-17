import Slider from '../../Components/Home/Slider';
import HomeCategory from '../../Components/Home/HomeCategory';
import CardProductsContainer from '../../Components/Products/CardProductsContainer';
import DiscountSection from '../../Components/Home/DiscountSection';
import BrandFeatured from '../../Components/Brand/BrandFeatured';

const HomePage = () => {
    return (
        <div className="font" style={{ minHeight:'670px' }}>
            <Slider />
            <HomeCategory />
            <CardProductsContainer title="الأكثر مبيعا" btntitle="المزيد" pathText='/products'/>
            <DiscountSection />
            <CardProductsContainer title="احدث الأزياء" btntitle="المزيد" pathText='/products'/>
            <BrandFeatured title="اشهر الماركات" btntitle="المزيد"/>
        </div>
    )
}

export default HomePage