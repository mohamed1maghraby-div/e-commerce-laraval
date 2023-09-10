import {
    Box,
    Button,
    CardActions,
    Container,
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
import { AddShoppingCartOutlined } from "@mui/icons-material";

const Main = () => {
    const [alignment, setAlignment] = useState("left");

    const handleAlignment = (event, newAlignment) => {
        setAlignment(newAlignment);
    };

    const theme = useTheme();
    return (
        <Container sx={{ mt: 9 }}>
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

            <Stack direction={"row"} flexWrap={"wrap"} justifyContent={"space-between"}>
                {["aaa", "bbb"].map((item) => {
                    return (
                        <Card key={item} sx={{ maxWidth: 333, mt: 6, ":hover .MuiCardMedia-root": {
                          rotate: "1deg",
                          scale: "1.1",
                          transition: "0.35s"
                          } }}>
                            <CardActionArea>
                                <CardMedia
                                    component="img"
                                    height="277"
                                    image="https://mui.com/static/images/cards/contemplative-reptile.jpg"
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
                                            T-shirt
                                        </Typography>
                                        <Typography
                                            variant="subtitle1"
                                            component="p"
                                        >
                                            $12.99
                                        </Typography>
                                    </Stack>
                                    <Typography
                                        variant="body2"
                                        color="text.secondary"
                                    >
                                        Lizards are a widespreed group of
                                        squamate reptiles, with over 6,000
                                        species, ranging across all continents
                                        except Antarctica
                                    </Typography>
                                </CardContent>
                                <CardActions
                                    sx={{ justifyContent: "space-between" }}
                                >
                                    <Button
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
                                        value={4.5}
                                        precision={0.5}
                                        readOnly
                                    />
                                </CardActions>
                            </CardActionArea>
                        </Card>
                    );
                })}
            </Stack>
        </Container>
    );
};
export default Main;
