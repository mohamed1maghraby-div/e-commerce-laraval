import {
    Box,
    Button,
    CardActions,
    Container,
    Dialog,
    IconButton,
    Rating,
    Stack,
    Typography,
    useTheme,
} from "@mui/material";
import ToggleButton from "@mui/material/ToggleButton";
import ToggleButtonGroup from "@mui/material/ToggleButtonGroup";
import { useState } from "react";
import Card from "@mui/material/Card";
import CardContent from "@mui/material/CardContent";
import CardMedia from "@mui/material/CardMedia";
import { CardActionArea } from "@mui/material";
import { AddShoppingCartOutlined, Close } from "@mui/icons-material";
import ProductDetails from "./ProductDetails";
import {useGetproductByNameQuery} from "../../src/Redux/product";

const Main = () => {
    const [alignment, setAlignment] = useState("left");

    const handleAlignment = (event, newAlignment) => {
        setAlignment(newAlignment);
    };

    const theme = useTheme();

    const [open, setOpen] = useState(false);

    const handleClickOpen = () => {
        setOpen(true);
    };

    const handleClose = () => {
        setOpen(false);
    };

    const { data, error, isLoading } = useGetproductByNameQuery()
    console.log(data);

    if(error){
        return (
            // @ts-ignore
            <Typography variant="h6" >{error.message}</Typography>
        )
    }

    if(isLoading){
        return (
            <Typography variant="h6" >LOADING................</Typography>
        )
    }
    if(data){

        return (
            <Container sx={{ py: 9 }}>
                <Stack
                    direction={"row"}
                    alignItems={"center"}
                    justifyContent={"space-between"}
                    flexWrap={"wrap"}
                    gap={3}
                >
                    <Box>
                        <Typography variant="h6">Selected Products</Typography>
                        <Typography fontWeight={300} variant="body1">
                            All our new arrivals in a exclusive brand selection
                        </Typography>
                    </Box>
    
                    <ToggleButtonGroup
                        color="error"
                        value={alignment}
                        exclusive
                        onChange={handleAlignment}
                        aria-label="text alignment"
                        sx={{
                            ".Mui-selected": {
                                border: "1px solid rgba(233, 69, 96, 0.5) !important",
                                color: "#e94560",
                                backgroundColor: "initial",
                            },
                        }}
                    >
                        <ToggleButton
                            sx={{ color: theme.palette.text.primary }}
                            className="myButton"
                            value="left"
                            aria-label="left aligned"
                        >
                            All Products
                        </ToggleButton>
                        <ToggleButton
                            sx={{
                                mx: "16px !important",
                                color: theme.palette.text.primary,
                            }}
                            className="myButton"
                            value="center"
                            aria-label="centered"
                        >
                            Men Category
                        </ToggleButton>
                        <ToggleButton
                            sx={{ color: theme.palette.text.primary }}
                            className="myButton"
                            value="right"
                            aria-label="right aligned"
                        >
                            Women Category
                        </ToggleButton>
                    </ToggleButtonGroup>
    
                    <Stack></Stack>
                </Stack>
    
                <Stack
                    direction={"row"}
                    flexWrap={"wrap"}
                    justifyContent={"space-between"}
                >
                    {data.map((item) => {
                        return (
                            <Card
                                key={item}
                                sx={{
                                    maxWidth: 333,
                                    mt: 6,
                                    ":hover .MuiCardMedia-root": {
                                        rotate: "1deg",
                                        scale: "1.1",
                                        transition: "0.35s",
                                    },
                                }}
                            >
                                <CardActionArea>
                                    <CardMedia
                                        component="img"
                                        height="277"// @ts-ignore
                                        image={`${import.meta.env.VITE_BASE_URL}/assets/products/${item.first_media.file_name}`}
                                        alt="green iguana"
                                    />
                                    <CardContent>
                                        <Stack
                                            direction={"row"}
                                            justifyContent={"space-between"}
                                            alignItems={"center"}
                                        >
                                            <Typography
                                                gutterBottom
                                                variant="h6"
                                                component="div"
                                            >
                                                {item.name}
                                            </Typography>
                                            <Typography
                                                variant="subtitle1"
                                                component="p"
                                            >
                                                ${item.price}
                                            </Typography>
                                        </Stack>
                                        <Typography
                                            variant="body2"
                                            color="text.secondary"
                                        >
                                            {item.description}
                                        </Typography>
                                    </CardContent>
                                    <CardActions
                                        sx={{ justifyContent: "space-between" }}
                                    >
                                        <Button
                                            onClick={handleClickOpen}
                                            sx={{ textTransform: "capitalize" }}
                                            size="large"
                                        >
                                            <AddShoppingCartOutlined
                                                sx={{ mr: 1 }}
                                                fontSize="small"
                                            />
                                            add to cart
                                        </Button>
                                        <Rating
                                            name="read-only"
                                            value={item.reviews_avg_rating}
                                            precision={0.5}
                                            readOnly
                                        />
                                    </CardActions>
                                </CardActionArea>
                            </Card>
                        );
                    })}
                </Stack>
    
                <Dialog
                    sx={{ ".MuiPaper-root": { minWidth: { xs: "100%", md: 800 } } }}
                    open={open}
                    onClose={handleClose}
                    aria-labelledby="alert-dialog-title"
                    aria-describedby="alert-dialog-description"
                >
                    <IconButton
                        sx={{
                            ":hover": {
                                color: "red",
                                rotate: "180deg",
                                transition: "0.3s",
                            },
                            position: "absolute",
                            top: 0,
                            right: 10,
                        }}
                        onClick={handleClose}
                    >
                        <Close />
                    </IconButton>
    
                    <ProductDetails />
                </Dialog>
            </Container>
        );
    }
};
export default Main;
