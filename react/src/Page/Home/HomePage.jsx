import NavBarLogin from '../../Components/Utility/NavBarLogin';
import Slider from '../../Components/Home/Slider';
import HomeCategory from '../../Components/Home/HomeCategory';
import CardProductsContainer from '../../Components/Products/CardProductsContainer';
import DiscountSection from '../../Components/Home/DiscountSection';

const HomePage = () => {
    return (
        <div className="font" style={{ minHeight:'670px' }}>
            <NavBarLogin />
            <Slider />
            <HomeCategory />
            <CardProductsContainer title="الأكثر مبيعا" btntitle="المزيد"/>
            <DiscountSection />
            <CardProductsContainer title="احدث الأزياء" btntitle="المزيد"/>
        </div>
    )
}

export default HomePage